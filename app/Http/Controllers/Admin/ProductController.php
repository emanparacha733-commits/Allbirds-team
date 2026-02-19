<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 🔹 Show all products in admin dashboard
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // 🔹 Show create form
    public function create()
    {
        return view('admin.products.create');
    }

    // 🔹 Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required|string',
            'type' => 'required|in:shoes,socks,apparel,accessories',
            'gender' => 'required|in:men,women,unisex',
            'color_name' => 'nullable|string',
            'color_hex' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'is_new' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'on_sale' => 'nullable|boolean',
        ]);

        // Image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Checkbox conversion
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['on_sale'] = $request->has('on_sale');

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    // 🔹 Show edit form
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // 🔹 Update product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required|string',
            'type' => 'required|in:shoes,socks,apparel,accessories',
            'gender' => 'required|in:men,women,unisex',
            'color_name' => 'nullable|string',
            'color_hex' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'is_new' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'on_sale' => 'nullable|boolean',
        ]);

        // Image update
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Checkbox conversion
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['on_sale'] = $request->has('on_sale');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // 🔹 Delete product
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
