<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\HomeSection;


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
        $emails = User::select('email')->get();
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
    }

    public function orders()
    {
        $orders = Order::with('items.product')->latest()->get();
        return view('layouts.admin.orders', compact('orders'));
    }

    public function customers()
    {
        return view('layouts.admin.customers.index', ['customers' => collect()]);
    }

    // ── Homepage Editor ───────────────────────────────────────────────
    public function homepageEditor()
    {
        $s = HomeSection::allAsArray();
        return view('layouts.admin.homepage-editor', compact('s'));
    }

    public function homepageUpdate(Request $request)
    {
        // ── HERO ──────────────────────────────────────────────────────
        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('home', 'public');
            HomeSection::setValue('hero', 'image', 'storage/' . $path);
        }
        HomeSection::setValue('hero', 'tagline',    $request->input('hero_tagline', ''));
        HomeSection::setValue('hero', 'heading',    $request->input('hero_heading', ''));
        HomeSection::setValue('hero', 'collection', $request->input('hero_collection', ''));

        // ── SECTION 2 — 4 cards ───────────────────────────────────────
        foreach (['s2_card_1', 's2_card_2', 's2_card_3', 's2_card_4'] as $card) {
            if ($request->hasFile("{$card}_image")) {
                $path = $request->file("{$card}_image")->store('home', 'public');
                HomeSection::setValue($card, 'image', 'storage/' . $path);
            }
            HomeSection::setValue($card, 'label', $request->input("{$card}_label", ''));
            HomeSection::setValue($card, 'link',  $request->input("{$card}_link", ''));
        }

        // ── SECTION 4 — header + 3 cards ─────────────────────────────
        HomeSection::setValue('s4_header', 'name', $request->input('s4_header_name', ''));
        HomeSection::setValue('s4_header', 'sub',  $request->input('s4_header_sub', ''));

        foreach (['s4_card_1', 's4_card_2', 's4_card_3'] as $card) {
            if ($request->hasFile("{$card}_image")) {
                $path = $request->file("{$card}_image")->store('home', 'public');
                HomeSection::setValue($card, 'image', 'storage/' . $path);
            }
            HomeSection::setValue($card, 'title',      $request->input("{$card}_title", ''));
            HomeSection::setValue($card, 'link_men',   $request->input("{$card}_link_men", '/men/shoes'));
            HomeSection::setValue($card, 'link_women', $request->input("{$card}_link_women", '/women/shoes'));
        }

        // ── SECTION 6 — 3 info cards ─────────────────────────────────
        foreach (['s6_card_1', 's6_card_2', 's6_card_3'] as $card) {
            HomeSection::setValue($card, 'title', $request->input("{$card}_title", ''));
            HomeSection::setValue($card, 'text',  $request->input("{$card}_text", ''));
        }

        return redirect()->route('admin.homepage')->with('success', 'Homepage updated successfully!');
    }

}