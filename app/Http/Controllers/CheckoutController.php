<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Product $product = null): View|Application|Factory
    {
        $categories = Category::all();
        if ($product) {
            $items = Cart::with('product.productImage')->whereProduct_id($product->id)->whereUser_id(auth()->user()->id)->whereIs_purchased(false)->get();
        }else{
            $items = Cart::with('product.productImage')->whereUser_id(auth()->user()->id)->whereIs_purchased(false)->get();
        }

        return view('pages.shop.checkout', ['items' => $items, 'categories' => $categories]);
    }
}
