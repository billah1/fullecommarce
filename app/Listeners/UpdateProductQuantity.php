<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductPurchased $event): void
    {
        $cartItem = Cart::find($event->cartId);
        $cartItem->is_purchased = true;
        $cartItem->save();
        if ($cartItem) {
            $product = $cartItem->product;
            $product->stock -= $cartItem->quantity;
            $product->save();
        }
    }
}
