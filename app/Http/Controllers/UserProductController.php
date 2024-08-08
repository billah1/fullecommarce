<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function productDetails(Product $product): View|Application|Factory
    {
        $item = $product->load('productImage',
            'productSize',
            'productColor',
            'productCoupon',
            'productCategory',
            'productCurrency',
            'category',
            'symbol');
        $categories = Category::all();
        return view('pages.shop.product-details',['item' => $item, 'categories' => $categories]);
    }
}
