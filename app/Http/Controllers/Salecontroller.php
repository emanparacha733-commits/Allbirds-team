<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SaleController extends Controller
{
    public function index() { return view('shop.sale.men-shoes'); }
    public function men(Request $request) { return view('shop.sale.men-shoes'); }
    public function menShoes(Request $request) { return view('shop.sale.men-shoes'); }
    public function menApparel(Request $request) { return view('shop.sale.men-apparel'); }
    public function menSocks(Request $request) { return view('shop.sale.men-socks'); }
    public function menClearance() { return view('shop.sale.men-shoes'); }
    public function menLastChance() { return view('shop.sale.men-shoes'); }
    public function menShoesCategory(Request $request, $category) { return view('shop.sale.men-shoes'); }
    public function menApparelCategory(Request $request, $category) { return view('shop.sale.men-apparel'); }
    public function menSocksCategory(Request $request, $category) { return view('shop.sale.men-socks'); }

    public function women(Request $request) { return view('shop.sale.women-shoes'); }
    public function womenShoes(Request $request) { return view('shop.sale.women-shoes'); }
    public function womenApparel(Request $request) { return view('shop.sale.women-apparel'); }
    public function womenSocks(Request $request) { return view('shop.sale.women-socks'); }
    public function womenClearance() { return view('shop.sale.women-shoes'); }
    public function womenLastChance() { return view('shop.sale.women-shoes'); }
    public function womenShoesCategory(Request $request, $category) { return view('shop.sale.women-shoes'); }
    public function womenApparelCategory(Request $request, $category) { return view('shop.sale.women-apparel'); }
    public function womenSocksCategory(Request $request, $category) { return view('shop.sale.women-socks'); }

    public function shoes() { return view('shop.sale.men-shoes'); }
    public function category($category) { return view('shop.sale.men-shoes'); }
}