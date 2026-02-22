<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $total = $subtotal >= 150 ? $subtotal * 0.7 : $subtotal;

        Order::create([
            'customer_name'  => $request->first_name . ' ' . $request->last_name,
            'customer_email' => $request->email,
            'items_count'    => collect($cart)->sum('quantity'),
            'total'          => $total,
            'status'         => 'pending',
        ]);

        session()->forget('cart');
        session()->save();

        return redirect()->route('order.success');
    }

    public function success()
    {
        return view('order-success');
    }
}