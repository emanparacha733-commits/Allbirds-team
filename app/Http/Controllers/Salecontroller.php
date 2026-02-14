<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('shop.sale.index');
    }

    public function men()
    {
        return view('shop.sale.men');
    }

    public function menShoes()
    {
        return view('shop.sale.men-shoes');
    }

    public function menShoesCategory($category)
    {
        return view('shop.sale.men-shoes-category', compact('category'));
    }

    public function menClearance()
    {
        return view('shop.sale.men-clearance');
    }

    public function menLastChance()
    {
        return view('shop.sale.men-last-chance');
    }

    public function women()
    {
        return view('shop.sale.women');
    }

    public function womenShoes()
    {
        return view('shop.sale.women-shoes');
    }

    public function womenShoesCategory($category)
    {
        return view('shop.sale.women-shoes-category', compact('category'));
    }

    public function womenClearance()
    {
        return view('shop.sale.women-clearance');
    }

    public function womenLastChance()
    {
        return view('shop.sale.women-last-chance');
    }

    public function category($category)
    {
        return view('shop.sale.category', compact('category'));
    }

    public function shoes()
    {
        return view('shop.sale.shoes');
    }
}