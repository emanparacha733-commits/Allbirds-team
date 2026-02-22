<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AdminController extends Controller
{

 // Show login form
    public function showLoginForm()
    {
        return view('layouts.admin.auth.login');
    }

    // Handle login (password only)
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

          // Assuming only one admin
        $admin = Admin::first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['password' => 'Invalid password']);
        }

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard');

    
    }

         public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
    
      public function showEmails()
    {
        $emails = User::select('email')->get(); // sirf emails
        return view('layouts.admin.email', compact('emails'));
    }

    
    public function dashboard()
    {
        return view('layouts.admin.dashboard', [
            'totalProducts'  => Product::count(),
            'totalOrders'    => Order::count(),
            'totalRevenue'   => Order::sum('total'),
            'recentProducts' => Product::latest()->take(5)->get(),

        ]);

        $emails = User::select('email')->get();

        return view('admin.emails', compact('emails'));
       
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