<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenController extends Controller
{
    public function collection($slug)
    {
        return view('shop.men.collection', compact('slug'));
    }

    public function newArrivals()
    {
        return view('shop.men.new-arrivals');
    }

    public function bestsellers()
    {
        return view('shop.men.bestsellers');
    }

    public function product($slug)
    {
        return view('shop.men.product', compact('slug'));
    }

    // ── Apparel ──────────────────────────────────────────
    public function apparel(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')->where('type', 'apparel');
        $query = $this->applySorting($query, $sort);
        $products = $query->get();

        return view('shop.men.apparel', compact('products'));
    }

    public function apparelNew()
    {
        return view('shop.men.apparel-new');
    }

    public function apparelCollection($slug)
    {
        return view('shop.men.apparel-collection', compact('slug'));
    }

    public function apparelCategory(Request $request, $category)
    {
        $query = Product::where('gender', 'men')->where('type', 'apparel');

        if ($category !== 'all-apparel') {
            $query->where('category', $category);
        }

        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);
        $products = $query->get();

        return view('shop.men.apparel-category', compact('products', 'category'));
    }

    // ── Socks ─────────────────────────────────────────────
    public function socks(Request $request)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')->where('type', 'socks');
        $query = $this->applySorting($query, $sort);
        $products = $query->get();

        return view('shop.men.socks', compact('products'));
    }

    public function socksCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')
                        ->where('type', 'socks')
                        ->where('category', $category);
        $query = $this->applySorting($query, $sort);
        $products = $query->get();

        return view('shop.men.socks-category', compact('products', 'category'));
    }

    // ── Shoes ─────────────────────────────────────────────
    public function shoesCategory(Request $request, $category)
    {
        $sort = $request->get('sort', 'featured');
        $query = Product::where('gender', 'men')
                        ->where('type', 'shoes')
                        ->where('category', $category);
        $query = $this->applySorting($query, $sort);
        $products = $query->get();

        return view('shop.men.shoes-category', compact('products', 'category'));
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