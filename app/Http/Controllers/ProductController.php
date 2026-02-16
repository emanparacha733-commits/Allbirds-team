<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Show all products
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        return view('layouts.admin.products.create');
    }

    /**
     * Store a newly created product in storage
     */
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
            'on_sale' => 'nullable|boolean',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'is_new' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sizes' => 'nullable|array',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert checkboxes to boolean
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['on_sale'] = $request->has('on_sale');

        // Handle sizes as JSON
        if ($request->has('sizes')) {
            $validated['sizes'] = $request->sizes;
        }

        Product::create($validated);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product)
    {
        return view('layouts.admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage
     */
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
            'on_sale' => 'nullable|boolean',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'is_new' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sizes' => 'nullable|array',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Convert checkboxes to boolean
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['on_sale'] = $request->has('on_sale');

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage
     */
    public function destroy(Product $product)
    {
        // Delete image file
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}