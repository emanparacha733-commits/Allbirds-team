<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        return view('checkout', compact('cart', 'subtotal'));
    }
    
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        
        $productId = $request->product_id;
        
        // If product already in cart, increase quantity
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            // Add new product to cart
            $cart[$productId] = [
                'id' => $request->product_id,
                'name' => $request->name,
                'price' => $request->price,
                'size' => $request->size ?? 'N/A',
                'image' => $request->image ?? 'images/product-placeholder.jpg',
                'quantity' => 1
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Product removed from cart!');
    }
    
    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = max(1, $request->quantity);
            session()->put('cart', $cart);
        }
        
        return redirect()->back();
    }
}












