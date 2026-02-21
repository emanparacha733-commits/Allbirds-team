<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('layouts.admin.dashboard', [
            'totalProducts'  => Product::count(),
            'totalOrders'    => Order::count(),
            'totalRevenue'   => Order::sum('total'),
            'recentProducts' => Product::latest()->take(5)->get(),
        ]);
    }

    public function orders()
    {
        $orders = Order::latest()->get();
        return view('layouts.admin.orders.index', compact('orders'));
    }

    public function customers()
    {
        return view('layouts.admin.customers.index', ['customers' => collect()]);
    }
}