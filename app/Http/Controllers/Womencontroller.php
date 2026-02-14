<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function shoesCategory($category)
    {
        return view('shop.women.shoes-category', compact('category'));
    }

    public function product($slug)
    {
        return view('shop.women.product', compact('slug'));
    }

    public function apparelNew()
    {
        return view('shop.women.apparel-new');
    }

    public function apparelCollection($slug)
    {
        return view('shop.women.apparel-collection', compact('slug'));
    }

    public function apparelCategory($category)
    {
        return view('shop.women.apparel-category', compact('category'));
    }

    public function socks()
    {
        return view('shop.women.socks');
    }

    public function socksCategory($category)
    {
        return view('shop.women.socks-category', compact('category'));
    }
}