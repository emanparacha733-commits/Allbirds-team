<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    public function index()
    {
        return view('shop.accessories.index');
    }

    public function category($category)
    {
        return view('shop.accessories.category', compact('category'));
    }
}