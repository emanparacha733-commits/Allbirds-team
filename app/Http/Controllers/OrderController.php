<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function place(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $total = $subtotal >= 150 ? $subtotal * 0.7 : $subtotal;

        // ✅ Create the order
        $order = Order::create([

          'first_name'     => $request->first_name,
    'last_name'      => $request->last_name,
    'customer_name'  => $request->first_name . ' ' . $request->last_name,
    'customer_email' => $request->email,
    'total'          => $total,
    'status'         => 'pending',
    'address'        => $request->address,   // Add this
    'city'           => $request->city,      // Add this
    'state'          => $request->state,     // Add this
    'zip'            => $request->zip,       // Add this
    'phone'          => $request->phone,     // Add this
   
        ]);

        // ✅ Save each cart item linked to the order
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');
        session()->save();

        return redirect()->route('order.success');
    }

    public function success()
    {
        return view('order-success');
    }
}