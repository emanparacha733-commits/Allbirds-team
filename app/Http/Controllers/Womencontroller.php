<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WomenController extends Controller
{
    public function collection($slug)
    {
        return view('shop.women.collection', compact('slug'));
    }

    public function newArrivals()
    {
        return view('shop.women.new-arrivals');
    }

    public function bestsellers()
    {
        return view('shop.women.bestsellers');
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return match($product->type) {
            'shoes'            => view('shop.women.detailshoes', compact('product')),
            'socks', 'apparel' => view('shop.women.detailsocks', compact('product')),
            default            => view('shop.women.detailsocks', compact('product')),
        };
    }

    // ── Apparel ──────────────────────────────────────────
    public function apparel(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::whereIn('gender', ['women', 'unisex'])->where('type', 'apparel');
        $query = $this->applySorting($query, $sort);
        $products = $query->get();

        return view('shop.women.apparel', compact('products'));
    }

    public function apparelNew()
    {
        return view('shop.women.apparel-new');
    }

    public function apparelCollection($slug)
    {
        return view('shop.women.apparel-collection', compact('slug'));
    }

    public function apparelCategory(Request $request, $category)
    {
        $query = Product::whereIn('gender', ['women', 'unisex'])->where('type', 'apparel');

        if ($category !== 'all-apparel') {
            $query->where('category', $category);
        }

        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);
        $product = $query->firstOrFail(); // ✅ FIXED: was ->get() into $products

        return view('shop.women.detailsocks', compact('product', 'category')); // ✅ FIXED
    }

    // ── Socks ─────────────────────────────────────────────
    public function socks(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::whereIn('gender', ['women', 'unisex'])->where('type', 'socks');
        $query = $this->applySorting($query, $sort);
        $products = $query->get();

        return view('shop.women.socks', compact('products'));
    }

    public function socksCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::whereIn('gender', ['women', 'unisex'])
                        ->where('type', 'socks')
                        ->where('category', $category);
        $query = $this->applySorting($query, $sort);
        $product = $query->firstOrFail(); // ✅ FIXED: was ->get() into $products

        return view('shop.women.detailsocks', compact('product', 'category')); // ✅ FIXED
    }

    // ── Shoes ─────────────────────────────────────────────
    public function shoesCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::whereIn('gender', ['women', 'unisex'])
                        ->where('type', 'shoes')
                        ->where('category', $category);
        $query = $this->applySorting($query, $sort);
        $products = $query->get();

        return view('shop.women.detailshoes', compact('products', 'category'));
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