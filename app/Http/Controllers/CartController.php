<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $cart = Cart::updateOrCreate(
            [
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
            ],
            [
                'quantity' => \DB::raw('quantity + ' . $request->quantity)
            ]
        );

        return response()->json(['message' => 'Product added to cart']);
    }

    public function update(Request $request)
    {
        $cart = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();
        }

        return response()->json(['message' => 'Cart updated']);
    }

    public function remove(Request $request)
    {
        Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json(['message' => 'Product removed from cart']);
    }
}
