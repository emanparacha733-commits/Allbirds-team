<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SaleController extends Controller
{
    public function index()
    {
        return view('shop.sale.index');
    }

    // ========================================
    // MEN'S SALE
    // ========================================
    
    public function men(Request $request)
    {
        return view('shop.sale.men');
    }

    public function menShoes(Request $request)
    {
        return view('shop.sale.men-shoes');
    }

    public function menShoesCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                       ->where('gender', 'men')
                       ->where('type', 'shoes')
                       ->where('on_sale', true)
                       ->whereNotNull('sale_price');

        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.sale.men-shoes-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function menApparel(Request $request)
    {
        return view('shop.sale.men-apparel');
    }

    public function menApparelCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                       ->where('gender', 'men')
                       ->where('type', 'apparel')
                       ->where('on_sale', true)
                       ->whereNotNull('sale_price');

        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.sale.men-apparel-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function menSocks(Request $request)
    {
        return view('shop.sale.men-socks');
    }

    public function menSocksCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                       ->where('gender', 'men')
                       ->where('type', 'socks')
                       ->where('on_sale', true)
                       ->whereNotNull('sale_price');

        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.sale.men-socks-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function menClearance()
    {
        return view('shop.sale.men-clearance');
    }

    public function menLastChance()
    {
        return view('shop.sale.men-last-chance');
    }

    // ========================================
    // WOMEN'S SALE
    // ========================================
    
    public function women(Request $request)
    {
        return view('shop.sale.women');
    }

    public function womenShoes(Request $request)
    {
        return view('shop.sale.women-shoes');
    }

    public function womenShoesCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                       ->where('gender', 'women')
                       ->where('type', 'shoes')
                       ->where('on_sale', true)
                       ->whereNotNull('sale_price');

        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.sale.women-shoes-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function womenApparel(Request $request)
    {
        return view('shop.sale.women-apparel');
    }

    public function womenApparelCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                       ->where('gender', 'women')
                       ->where('type', 'apparel')
                       ->where('on_sale', true)
                       ->whereNotNull('sale_price');

        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.sale.women-apparel-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function womenSocks(Request $request)
    {
        return view('shop.sale.women-socks');
    }

    public function womenSocksCategory(Request $request, $category)
    {
        $query = Product::where('category', $category)
                       ->where('gender', 'women')
                       ->where('type', 'socks')
                       ->where('on_sale', true)
                       ->whereNotNull('sale_price');

        $sort = $request->get('sort', 'featured');
        $query = $this->applySorting($query, $sort);

        $products = $query->get();

        return view('shop.sale.women-socks-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function womenClearance()
    {
        return view('shop.sale.women-clearance');
    }

    public function womenLastChance()
    {
        return view('shop.sale.women-last-chance');
    }

    // ========================================
    // GENERAL SALE
    // ========================================
    
    public function shoes()
    {
        return view('shop.sale.shoes');
    }

    public function category($category)
    {
        return view('shop.sale.category', compact('category'));
    }

    // ========================================
    // HELPER METHOD
    // ========================================
    
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
                return $query->orderBy('sale_price', 'asc');
            
            case 'price_high':
                return $query->orderBy('sale_price', 'desc');
            
            case 'discount':
                return $query->orderByRaw('((price - sale_price) / price * 100) DESC');
            
            case 'featured':
            default:
                return $query->orderBy('is_featured', 'desc')
                            ->orderBy('created_at', 'desc');
        }
    }
}