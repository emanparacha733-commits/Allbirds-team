<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cart = session('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return view('checkout', compact('cart', 'subtotal', 'cartCount'));
    }

    // Add item to cart
    public function add(Request $request)
    {
        $cart = session('cart', []);

        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'name'     => $request->name,
                'price'    => $request->price,
                'size'     => $request->size,
                'image'    => $request->image,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('cart_updated', true);
    }

    // Update quantity
    public function updateQuantity(Request $request)
    {
        $cart = session('cart', []);
        $productId = $request->product_id;
        $quantity = (int) $request->quantity;

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]); // Remove if quantity reaches 0
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        session(['cart' => $cart]);

        return back();
    }

    // Remove item from cart
    public function remove(Request $request)
    {
        $cart = session('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session(['cart' => $cart]);

        return back();
    }
}