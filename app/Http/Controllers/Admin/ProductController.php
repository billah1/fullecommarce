<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Jobs\Admin\SendNewProductEmail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Currency;
use App\Models\ProductImage;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductController extends Controller
{
    public function addNewProduct()
    {

        $admins = User::all();
        $categories = Category::get();
        $colors = Color::get();
        $currencies = Currency::get();

        return view('Admin.pages.product.create', ['title' => 'Add New Product',
            'categories' => $categories,
            'admins' => $admins,
            'colors' => $colors,
            'currencies' => $currencies
        ]);
    }

    public function productStore(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'image' => 'required|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Example for image files
                // Add other fields and rules as needed
            ]);

            DB::beginTransaction();
            $photoString = $request->input('photo')[0];
            $photoArray = explode(',', $photoString);
            $tags = json_encode($request->tag);
            $status = request('publish', 'off');
            $coupon = request('coupon', 'off');
            $code = generateProductCode();
            $product = Product::create([
                'currency_id' => $request->currency,
                'created_by' => $request->added_by,
                'code' => $code,
                'name' => $request->name,
                'description' => $request->description,
                'tags' => $tags,
                'price' => $request->price,
                'product_code' => $request->product_code,
                'discount_price' => $request->discount_price,
                'stock' => $request->stock,
                'is_active' => ($status === 'on') ? true : false,
                'has_coupon' => ($coupon === 'on') ? true : false,
            ]);

            foreach ($request->category as $category) {
                $product->productCategory()->create([
                    'product_id' => $product->id,
                    'category_id' => $category,
                ]);
            }

            foreach ($request->file('image') as $photo) {
                if (in_array($photo->getClientOriginalName(), $photoArray)) {
                    $image = $product->productImage()->create([
                        'product_id' => $product->id,
                    ]);
                    upload($image, $photo, 'image');
                }
            }

            if ($coupon === 'on') {
                $product->productCoupon()->create([
                    'product_id' => $product->id,
                    'coupon_code' => $request->coupon_code,
                    'percentage' => $request->coupon_percentage
                ]);
            }
            DB::commit();
        } catch (Exception $exception) {
            dd($exception->getMessage());
            DB::rollback();
            toastr()->error('Something went wrong!!!');
        }
        toastr()->success('Product created successfully!!!');
        return redirect()->route('admin.productList');
    }

    public function productUpdate(Request $request, Product $product)
    {
//        dd($request->all(), $product);
        try {
            DB::beginTransaction();
            $photoString = $request->input('photo')[0];
            $photoArray = explode(',', $photoString);
            $tags = json_encode($request->tag);
            $status = request('publish', 'off');
            $coupon = request('coupon', 'off');
            $product->update([
                'currency_id' => $request->currency,
                'created_by' => $request->added_by,
                'name' => $request->name,
                'description' => $request->description,
                'tags' => $tags,
                'product_code' => $request->product_code,
                'discount_price' => $request->discount_price,
                'price' => $request->price,
                'stock' => $request->stock,
                'is_active' => ($status === 'on') ? true : false,
            ]);

            foreach ($request->category as $category) {
                $product->productCategory()->updateOrCreate(
                    [
                        // Conditions to check existing record
                        'product_id' => $product->id,
                        'category_id' => $category,
                    ],
                    [
                        // Fields to update or create
                        'product_id' => $product->id,
                        'category_id' => $category,
                    ]
                );
            }
            if ($request->file('image') != '') {
                foreach ($request->file('image') as $photo) {
                    if (in_array($photo->getClientOriginalName(), $photoArray)) {
                        $image = $product->productImage()->create([
                            'product_id' => $product->id,
                        ]);
                        upload($image, $photo, 'image');
                    }
                }
            }

            if ($coupon === 'on') {
                if ($product->has_coupon === true) {
                    $product->productCoupon()->update([
                        'product_id' => $product->id,
                        'coupon_code' => $request->coupon_code,
                        'percentage' => $request->coupon_percentage
                    ]);
                }
            }
            DB::commit();
            toastr()->success('Product updated successfully!!!');
        } catch (Exception $exception) {
            DB::rollback();
            toastr()->error('Something went wrong!!!');
        }


        return redirect()->route('admin.productList');
    }

    public function edit($code)
    {
        $product = Product::with('productImage', 'productCategory')->whereCode($code)->first();
        $admins = User::all();
        $categories = Category::get();
        $colors = Color::get();
        $currencies = Currency::get();

        return view('Admin.pages.product.edit', ['title' => 'Edit Product',
            'categories' => $categories,
            'admins' => $admins,
            'colors' => $colors,
            'currencies' => $currencies,
            'product' => $product
        ]);
    }

    public function showProductList(): View|Application|Factory
    {
        $perPage = request()->input('perPage', 10);
        $items = Product::with('productImage', 'productSize', 'productColor', 'productCoupon', 'productCurrency', 'productCategory')
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        return view('Admin.pages.product.list', ['title' => 'Product List',
            'items' => $items
        ]);
    }

    public function toggle(Request $request, $product): JsonResponse
    {

        try {
            $status = (bool)$request->input('status');

            $products = Product::where('code', $product)->get();
            foreach ($products as $product) {
                $product->update(['is_active' => $status]);
            }
            $data = ['message' => 'Success! status updated', 'is_active' => $product->is_active, 'id' => $product->id];
        } catch (Exception $exception) {
            $data['message'] = 'Sorry! something went wrong';

            return response()->json($data, $status = 500);
        }

        return response()->json($data);
    }

    public function delete($product): RedirectResponse
    {
        try {
            $products = Product::where('code', $product)->get();
            foreach ($products as $product) {
                $product->delete();
            }
        } catch (Exception $exception) {
            dd($exception);
        }

        return back();
    }

    public function deleteImage($id)
    {
        $image = ProductImage::whereId($id)->first();

        if (!$image) {
            return response()->json(['success' => false, 'message' => 'Image not found']);
        }

        // Define the path to the image
        $imagePath = public_path('admin/product/' . $image->image);

        // Check if the image file exists and delete it
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image->delete(); // Delete the image record from the database

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }

    public function importProducts(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:csv,xls',
        ]);

        try {
            Excel::import(new ProductsImport, $validatedData['file']);
        } catch (Exception $exception) {
            toastr()->error('Something went wrong!!!');
        }
        toastr()->success('Import Success!!');
        return back();
    }

    public function exportProducts(): BinaryFileResponse
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
