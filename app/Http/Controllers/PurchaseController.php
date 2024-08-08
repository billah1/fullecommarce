<?php

namespace App\Http\Controllers;

use App\Events\ProductPurchased;
use App\Jobs\SendOrderInvoiceEmail;
use App\Models\BillingDetails;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderedProduct;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'company_name' => 'nullable|string|max:255',
                'country' => 'required|string|max:255',
                'address1' => 'required|string|max:255',
                'address2' => 'nullable|string|max:255',
                'town_city' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'note' => 'nullable|string',
            ]);
            $paymentType = request('payment_type', 'off');
            DB::beginTransaction();
            $billingDetails = BillingDetails::create([
                'name' => $request->full_name,
                'company_name' => $request->company_name,
                'country' => $request->country,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => $request->note,
            ]);

            $order = $billingDetails->order()->create([
                'billing_detail_id' => $billingDetails->id,
                'ordered_by' => auth()->user()->id,
                'order_code' => generateOrderNumber(),
                'shipping_charge' => 0,
                'discount' => $request->discount,
                'total_charge' => $request->total_charge,
                'payment_type' => ($paymentType === 'on') ? 'cash' : 'online',
            ]);
            foreach ($request->cart_ids as $cartId) {
                $orderedProduct = $order->orderProducts()->create([
                    'order_id' => $order->id,
                    'cart_id' => $cartId,
                ]);
                event(new ProductPurchased($cartId));
            }
            DB::commit();
            dispatch(new SendOrderInvoiceEmail($order));

            toastr()->Success('You have successfully created a new order!!!');
            return redirect()->route('user.order.success', ['order' => $order]);

        } catch (Exception $exception) {
            DB::rollback();
            toastr()->error('Something went wrong');
        }
    }

    public function success(Order $order): View|Application|Factory
    {
        $categories = Category::all();
        return view('pages.shop.purchase-success', ['order' => $order, 'categories' => $categories]);
    }
}
