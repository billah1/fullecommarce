<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {

        $products = Product::with('productImage')->get();
        $categories = Category::all();
        $sliders = Slider::get();
        $banners = Banner::get();
        return view('pages.Home.home', ['products' => $products,
            'categories' => $categories,
            'banners' => $banners,
            'sliders' => $sliders]);
    }

    public function contactUs()
    {
        $products = Product::with('productImage')->get();
        $categories = Category::all();
        $sliders = Slider::get();
        $banners = Banner::get();
        return view('pages.contact-us.contact-us', ['products' => $products,
            'categories' => $categories,
            'banners' => $banners,
            'sliders' => $sliders]);
    }
}
