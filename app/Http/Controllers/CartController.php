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
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'quantity' => $request->quantity
            ]);
        }

        return response()->json(['message' => 'Product added to cart']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();
            return response()->json(['message' => 'Cart updated']);
        }

        return response()->json(['message' => 'Cart item not found'], 404);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $cart = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->delete();
            return response()->json(['message' => 'Product removed from cart']);
        }

        return response()->json(['message' => 'Cart item not found'], 404);
    }
}
