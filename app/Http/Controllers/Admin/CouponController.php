<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponUsage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function showAllCoupons()
    {
        $items = Coupon::paginate(10);

        return view('Admin.pages.Coupon.list', ['items' => $items, 'title' => 'Coupon list']);
    }

    public function couponStore(Request $request)
    {
        try {
            $status = request('status', 'off');
            Coupon::create([
                'coupon_code' => $request->coupon_code,
                'percentage' => $request->percentage,
                'valid_till' => $request->valid_till,
                'user_limit' => $request->user_limit,
                'is_active' => ($status === 'on') ? true : false,
            ]);
        } catch (Exception $exception) {
            toastr()->Error('Something Went Wrong!!!');
        }
        toastr()->Success('You have successfully created a new Coupon!!!');

        return back();
    }

    public function toggle(Request $request, Coupon $coupon): JsonResponse
    {
        try {
            $status = (bool)$request->input('status');
            $coupon->update(['is_active' => $status]);
            $data = ['message' => 'Success! status updated', 'is_active' => $coupon->is_active, 'id' => $coupon->id];
        } catch (Exception $exception) {
            $data['message'] = 'Sorry! something went wrong';

            return response()->json($data, $status = 500);
        }

        return response()->json($data);
    }

    public function edit(Request $request, Coupon $coupon): RedirectResponse
    {
        try {
            $status = request('status', 'off');
            $coupon->update([
                'coupon_code' => $request->coupon_code,
                'percentage' => $request->percentage,
                'user_limit' => $request->user_limit,
                'valid_till' => $request->valid_till,
                'is_active' => ($status === 'on') ? true : false,
            ]);
        } catch (Exception $exception) {
            toastr()->Error('Something Went Wrong!!!');
        }
        toastr()->Success('You have successfully updated a Coupon!!!');

        return back();
    }

    public function delete(Coupon $coupon)
    {
        try {
            $coupon->delete();
        } catch (Exception $exception) {
            toastr()->Error('Something Went Wrong!!!');
        }
        toastr()->Success('You have successfully Deleted a Coupon!!!');

        return back();
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon');

        $exist = Coupon::whereCoupon_code($couponCode)->where('valid_till', ">=", date('Y-m-d'))->whereIs_active(true)->first();
        $usage = CouponUsage::whereCoupon_id($exist->id)->whereUser_id(auth()->user()->id)->first();
        if ($exist && ($exist->user_limit > optional($usage)->usage || !$usage)) {
            if ($usage) {
                $usage->update([
                    'usage' => $usage->usage + 1
                ]);
            }else {
                CouponUsage::create([
                    'coupon_id' => $exist->id,
                    'user_id'   => auth()->user()->id,
                    'usage'     => 1
                ]);
            }
            $newSubtotal = $request->subtotal - (($exist->percentage / 100) * $request->subtotal);
            return response()->json(['success' => true, 'newSubtotal' => $newSubtotal, 'discount' => $exist->percentage]);
        } else {
            return response()->json(['success' => false, 'error' => 'Invalid coupon code']);
        }
    }
}
