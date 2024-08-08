<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showAllOrder()
    {
        $items = Order::with('user')->paginate(10);

        return view('Admin.pages.order.list', ['items' => $items, 'title' => 'Order List']);
    }

    public function completeOrder(Order $order): RedirectResponse
    {
        try {
            $order->update([
               'status' => Order::STATUS_COMPLETED
            ]);
        }catch (Exception $exception) {
            toastr()->error('something went wrong!');
        }
        toastr()->success('Status Changed successfully!!!');
        return back();
    }
}
