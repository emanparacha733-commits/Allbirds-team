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

    public function shoesCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                       ->where('gender', 'women')
                       ->where('type', 'shoes');

        // Apply sorting
        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.women.shoes-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function product($slug)
    {
        $product = Product::findOrFail($slug);

        $relatedProducts = Product::query()
            ->forGender('women')
            ->ofType($product->type)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(6)
            ->get();

        return view('shop.women.detailshoes', compact('product', 'relatedProducts'));
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
        $query = Product::where('gender', 'women')
                       ->where('type', 'apparel');
        
        if ($category !== 'all-apparel') {
            $query->where('category', $category);
        }

        // Apply sorting
        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);
        
        $products = $query->get();

        return view('shop.women.apparel-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    /**
     * Show all women's socks (all categories)
     */
    public function socks(Request $request)
    {
        $query = Product::where('gender', 'women')
                       ->where('type', 'socks');

        // Apply sorting
        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.women.socks', compact('products'));
    }

    /**
     * Show women's socks by specific category
     */
    public function socksCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                       ->where('gender', 'women')
                       ->where('type', 'socks');

        // Apply sorting
        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.women.socks-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    /**
     * Apply sorting to query based on sort parameter
     */
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