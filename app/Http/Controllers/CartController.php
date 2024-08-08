<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        // Add the product to the cart
        // Assuming you have a Cart model or a similar logic
        $exist = Cart::whereUser_id(auth()->user()->id)->whereProduct_id($productId)->whereIs_purchased(false)->first();
        if($exist) {
            $newQuantity = $exist->quantity+$quantity;
            $newPrice = $exist->total_price+$price;
            $exist->update([
                'quantity' => $newQuantity,
                'total_price' => $newPrice
            ]);
            $data = $exist->fresh();
        }else {
            $data = Cart::create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'user_id' => auth()->user()->id,
                'price' => $price,
                'total_price' => $price
            ]);
        }

        $data = Cart::with('product.productImage')->whereUser_id(auth()->user()->id)->whereIs_purchased(false)->get();

        return response()->json(['data' => $data, 'message' => 'Product added to cart successfully']);
    }

    public function deleteToCart(Request $request)
    {
        $cartId = $request->input('cart_id');

        // Find the cart item
        $cartItem = Cart::whereId($cartId)->whereIs_purchased(false)->first();

        if ($cartItem) {
            // Delete the cart item if it exists
            $cartItem->delete();
        } else {
            // Handle the case where the cart item doesn't exist
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        // Retrieve updated cart items
        $updatedCartItems = Cart::with('product.productImage')
            ->whereUser_id(auth()->user()->id)
            ->whereIs_purchased(false)
            ->get();

        return response()->json(['data' => $updatedCartItems, 'message' => 'Product removed from cart successfully']);
    }
}
