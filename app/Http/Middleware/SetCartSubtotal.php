<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCartSubtotal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $cartItems = Cart::with('product.productImage')->whereUser_id($request->user()->id)->whereIs_purchased(false)->get();
            $subtotal = $cartItems->sum('total_price');
        } else {
            $subtotal = 0;
            $cartItems = [];
        }

        view()->share([
            'subtotal' => $subtotal,
            'cartItems' => $cartItems
        ]);

        return $next($request);
    }
}
