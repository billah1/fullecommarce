<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function showAllCategory(): View|Application|Factory
    {
        $perPage = request()->input('perPage', 10);
        $categories = Category::orderBy('id', 'desc')->paginate($perPage);

        return view('Admin.pages.category.showAllCategory', ['title' => 'categories', 'categories' => $categories]);
    }

    public function categoryStore(Request $request): RedirectResponse
    {
        try {
            $status = request('status', 'off');
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'is_active' => ($status === 'on') ? true : false,
            ]);

        }catch (Exception $exception) {
            dd($exception);
        }

        return back();
    }

    public function toggle(Request $request, Category $category): JsonResponse
    {
        try {
            $status = (bool) $request->input('status');
            $category->update(['is_active' => $status]);
            $data = ['message' => 'Success! status updated', 'is_active' => $category->is_active, 'id' => $category->id];
        } catch (Exception $exception) {
            $data['message'] = 'Sorry! something went wrong';

            return response()->json($data, $status = 500);
        }

        return response()->json($data);
    }

    public function edit(Request $request, Category $category): RedirectResponse
    {
        try {
            $status = request('status', 'off');
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'is_active' => ($status === 'on') ? true : false,
            ]);
        }catch (Exception $exception) {
            dd($exception);
        }
        return back();
    }

    public function delete(Category $category)
    {
        try {
            $category->delete();
        }catch (Exception $exception) {
            dd($exception);
        }

        return back();
    }

}
