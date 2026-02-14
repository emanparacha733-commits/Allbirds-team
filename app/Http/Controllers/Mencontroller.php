<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Make sure to import your Model!

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

    public function apparelNew()
    {
        return view('shop.men.apparel-new');
    }

    public function apparelCollection($slug)
    {
        return view('shop.men.apparel-collection', compact('slug'));
    }

    // Fixed: Logic moved inside the method
    public function apparelCategory($category)
    {
        $products = Product::where('category', $category)
                    ->where('gender', 'men')
                    ->get();

        return view('shop.men.apparel-category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function socks()
    {
        return view('shop.men.socks');
    }

    // Fixed: Logic moved inside the method
    public function socksCategory($category)
    {
        // This fetches the products needed for the grid in your image
        $products = Product::where('category', $category)
                    ->where('gender', 'men')
                    ->get();

        return view('shop.men.socks-category', [
            'category' => $category,
            'products' => $products
        ]);
    }
}