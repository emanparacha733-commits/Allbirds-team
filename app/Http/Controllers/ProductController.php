<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create()
    {
        return view('layouts.admin.products.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'category' => 'required',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'image' => $imagePath,
            'category' => $request->category,
            'price' => $request->price,
            'is_new' => $request->has('is_new'),
        ]);

        return redirect()->back()->with('success', 'Product added!');
    }
    public function index()
{
    $products = Product::all(); // ← gets all products from database

    return view('products.index', compact('products'));
}
}
