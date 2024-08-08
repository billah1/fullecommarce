<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderedProduct;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class InvoiceController extends Controller
{
    public function showInvoice(Order $order)
    {
        $order = $order->load('billingDetail');
        $items = OrderedProduct::with('cart.product')->whereOrder_id($order->id)->get();
        $categories = Category::all();

        return view('pages.invoice.invoice', ['order' => $order, 'items' => $items, 'categories' => $categories]);
    }
}
