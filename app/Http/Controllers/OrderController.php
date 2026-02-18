<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        // Get cart before clearing
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        // TODO: Save order to database here if needed
        // For now, just clear cart and show success

        session()->forget('cart');
        session()->save();

        return redirect()->route('order.success');
    }

    public function success()
    {
        return view('order-success');
    }
}