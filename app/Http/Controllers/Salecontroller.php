<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SaleController extends Controller
{
    // ── General ───────────────────────────────────────────
    public function index()
    {
        $products = Product::where('on_sale', true)->latest()->get();
        return view('shop.sale.index', compact('products'));
    }

    public function shoes()
    {
        $products = Product::where('on_sale', true)
                           ->where('type', 'shoes')
                           ->latest()->get();
        return view('shop.sale.shoes', compact('products'));
    }

    public function category($category)
    {
        $products = Product::where('on_sale', true)
                           ->where('category', $category)
                           ->latest()->get();
        return view('shop.sale.category', compact('products', 'category'));
    }

    // ── Men ───────────────────────────────────────────────
    public function men(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.men', ['products' => $query->get()]);
    }

    public function menClearance()
    {
        $products = Product::where('gender', 'men')
                           ->where('on_sale', true)
                           ->latest()->get();
        return view('shop.sale.men-clearance', compact('products'));
    }

    public function menLastChance()
    {
        $products = Product::where('gender', 'men')
                           ->where('on_sale', true)
                           ->latest()->get();
        return view('shop.sale.men-last-chance', compact('products'));
    }

    // Men — Shoes
    public function menShoes(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')
                        ->where('type', 'shoes')
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.men-shoes', ['products' => $query->get()]);
    }

    public function menShoesCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')
                        ->where('type', 'shoes')
                        ->where('category', $category)
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.men-shoes-category', ['products' => $query->get(), 'category' => $category]);
    }

    // Men — Apparel
    public function menApparel(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')
                        ->where('type', 'apparel')
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.men-apparel', ['products' => $query->get()]);
    }

    public function menApparelCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')
                        ->where('type', 'apparel')
                        ->where('category', $category)
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.men-apparel-category', ['products' => $query->get(), 'category' => $category]);
    }

    // Men — Socks
    public function menSocks(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')
                        ->where('type', 'socks')
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.men-socks', ['products' => $query->get()]);
    }

    public function menSocksCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')
                        ->where('type', 'socks')
                        ->where('category', $category)
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.men-socks-category', ['products' => $query->get(), 'category' => $category]);
    }

    // ── Women ─────────────────────────────────────────────
    public function women(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'women')->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.women', ['products' => $query->get()]);
    }

    public function womenClearance()
    {
        $products = Product::where('gender', 'women')
                           ->where('on_sale', true)
                           ->latest()->get();
        return view('shop.sale.women-clearance', compact('products'));
    }

    public function womenLastChance()
    {
        $products = Product::where('gender', 'women')
                           ->where('on_sale', true)
                           ->latest()->get();
        return view('shop.sale.women-last-chance', compact('products'));
    }

    // Women — Shoes
    public function womenShoes(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'women')
                        ->where('type', 'shoes')
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.women-shoes', ['products' => $query->get()]);
    }

    public function womenShoesCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'women')
                        ->where('type', 'shoes')
                        ->where('category', $category)
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.women-shoes-category', ['products' => $query->get(), 'category' => $category]);
    }

    // Women — Apparel
    public function womenApparel(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'women')
                        ->where('type', 'apparel')
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.women-apparel', ['products' => $query->get()]);
    }

    public function womenApparelCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'women')
                        ->where('type', 'apparel')
                        ->where('category', $category)
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.women-apparel-category', ['products' => $query->get(), 'category' => $category]);
    }

    // Women — Socks
    public function womenSocks(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'women')
                        ->where('type', 'socks')
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.women-socks', ['products' => $query->get()]);
    }

    public function womenSocksCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'women')
                        ->where('type', 'socks')
                        ->where('category', $category)
                        ->where('on_sale', true);
        $query = $this->applySorting($query, $sort);
        return view('shop.sale.women-socks-category', ['products' => $query->get(), 'category' => $category]);
    }

    // ── Sorting ───────────────────────────────────────────
    private function applySorting($query, $sort)
    {
        switch ($sort) {
            case 'best_selling':
            case 'best':
                return $query->orderBy('sales_count', 'desc');
            case 'alpha_asc':
            case 'az':
                return $query->orderBy('name', 'asc');
            case 'alpha_desc':
            case 'za':
                return $query->orderBy('name', 'desc');
            case 'price_low':
                return $query->orderBy('price', 'asc');
            case 'price_high':
                return $query->orderBy('price', 'desc');
            case 'featured':
            default:
                return $query->orderBy('is_featured', 'desc')
                             ->orderBy('created_at', 'desc');
        }
    }
}