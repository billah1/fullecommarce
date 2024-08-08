<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function index(): View|Application|Factory
    {
        $categories = Category::all();
        $orders = Order::with('billingDetail')->whereOrdered_by(auth()->user()->id)->get();
        return view('pages.my-account.account', ['categories' => $categories, 'orders' => $orders]);
    }
}
