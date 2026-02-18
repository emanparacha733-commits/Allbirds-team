<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Show all products
    public function index(Request $request, $gender = null, $category = null)
    {
        $products = Product::query();

        if ($gender) $products->forGender($gender);
        if ($category) $products->ofCategory($category);

        // Sorting
        switch ($request->get('sort')) {
            case 'best_selling':
                $products->bestSelling();
                break;
            case 'price_low':
                $products->priceLowToHigh();
                break;
            case 'price_high':
                $products->priceHighToLow();
                break;
            case 'alpha_asc':
                $products->alphabetically('asc');
                break;
            case 'alpha_desc':
                $products->alphabetically('desc');
                break;
            default:
                $products->latest();
        }

        return view('products.index', [
            'products' => $products->get(),
            'category' => $category,
            'gender' => $gender
        ]);
    }

    // Show create form
    public function create()
    {
        return view('layouts.admin.products.create');
    }

    // Store product
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

        // Image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Checkbox conversion
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['on_sale'] = $request->has('on_sale');

        // Ensure sizes always exists
        $validated['sizes'] = $request->input('sizes', []);

        Product::create($validated);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    // Edit product
    public function edit(Product $product)
    {
        return view('layouts.admin.products.edit', compact('product'));
    }

    // Update product
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

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['on_sale'] = $request->has('on_sale');
        $validated['sizes'] = $request->input('sizes', []);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
