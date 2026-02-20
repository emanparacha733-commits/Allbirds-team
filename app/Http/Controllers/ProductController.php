<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private function applySorting($query, Request $request)
    {
        switch ($request->get('sort')) {
            case 'best_selling': $query->bestSelling(); break;
            case 'price_low':    $query->priceLowToHigh(); break;
            case 'price_high':   $query->priceHighToLow(); break;
            case 'alpha_asc':    $query->alphabetically('asc'); break;
            case 'alpha_desc':   $query->alphabetically('desc'); break;
            default:             $query->latest();
        }
        return $query;
    }

    public function menShoes(Request $request)
    {
        $products = Product::query()->forGender('men')->ofType('shoes');
        $this->applySorting($products, $request);
        return view('shop.men.shoes', ['products' => $products->get(), 'gender' => 'men', 'category' => null]);
    }

    public function menShoesByCategory(Request $request, $category)
    {
        $products = Product::query()->forGender('men')->ofType('shoes');
        $this->applySorting($products, $request);
        return view('shop.men.shoes', ['products' => $products->get(), 'gender' => 'men', 'category' => $category]);
    }

    public function womenShoes(Request $request)
    {
        $products = Product::query()->forGender('women')->ofType('shoes');
        $this->applySorting($products, $request);
        return view('shop.women.shoes', ['products' => $products->get(), 'gender' => 'women', 'category' => null]);
    }

    public function womenShoesByCategory(Request $request, $category)
    {
        $products = Product::query()->forGender('women')->ofType('shoes');
        $this->applySorting($products, $request);
        return view('shop.women.shoes', ['products' => $products->get(), 'gender' => 'women', 'category' => $category]);
    }

    public function index(Request $request, $gender = null, $category = null)
    {
        $products = Product::query();
        if ($gender)   $products->forGender($gender);
        if ($category) $products->ofCategory($category);
        $this->applySorting($products, $request);
        return view('products.index', ['products' => $products->get(), 'category' => $category, 'gender' => $gender]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::query()
            ->forGender($product->gender)
            ->ofType($product->type)
            ->where('id', '!=', $product->id)
            ->latest()->take(6)->get();
        return view('shop.men.detailshoes', compact('product', 'relatedProducts'));
    }

<<<<<<< HEAD
    // ─── Admin CRUD ───────────────────────────────────────────────────────────────

   public function create()
{
    return view('admin.products.create');
}

=======
    public function create()
    {
        return view('layouts.admin.products.create');
    }
>>>>>>> 2dfb1acd4684193dddcc66709102106e76bc3f8d

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_2'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_3'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category'    => 'required|string',
            'type'        => 'required|in:shoes,socks,apparel,accessories',
            'gender'      => 'required|in:men,women,unisex',
            'color_name'  => 'nullable|string',
            'color_hex'   => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'on_sale'     => 'nullable|boolean',
            'sale_price'  => 'nullable|numeric|min:0',
            'is_new'      => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sizes'       => 'nullable|array',
        ]);

        $validated['image'] = $request->file('image')->store('products', 'public');

        if ($request->hasFile('image_2')) {
            $validated['image_2'] = $request->file('image_2')->store('products', 'public');
        }

        if ($request->hasFile('image_3')) {
            $validated['image_3'] = $request->file('image_3')->store('products', 'public');
        }

        $variants = [];
        if ($request->has('variants')) {
            foreach ($request->variants as $i => $variant) {
                if (empty($variant['color_name'])) continue;
                $v = [
                    'color_name' => $variant['color_name'],
                    'color_hex'  => $variant['color_hex'] ?? '#000000',
                    'image'      => null,
                ];
                if ($request->hasFile("variants.{$i}.image")) {
                    $v['image'] = $request->file("variants.{$i}.image")->store('products', 'public');
                }
                $variants[] = $v;
            }
        }
        $validated['color_variants'] = $variants;

        $validated['is_new']      = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['on_sale']     = $request->has('on_sale');
        $validated['sizes']       = $request->input('sizes', []);

        Product::create($validated);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        return view('layouts.admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_2'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_3'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category'    => 'required|string',
            'type'        => 'required|in:shoes,socks,apparel,accessories',
            'gender'      => 'required|in:men,women,unisex',
            'color_name'  => 'nullable|string',
            'color_hex'   => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'on_sale'     => 'nullable|boolean',
            'sale_price'  => 'nullable|numeric|min:0',
            'is_new'      => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sizes'       => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('image_2')) {
            if ($product->image_2) Storage::disk('public')->delete($product->image_2);
            $validated['image_2'] = $request->file('image_2')->store('products', 'public');
        }

        if ($request->hasFile('image_3')) {
            if ($product->image_3) Storage::disk('public')->delete($product->image_3);
            $validated['image_3'] = $request->file('image_3')->store('products', 'public');
        }

        $variants = [];
        if ($request->has('variants')) {
            foreach ($request->variants as $i => $variant) {
                if (empty($variant['color_name'])) continue;
                $v = [
                    'color_name' => $variant['color_name'],
                    'color_hex'  => $variant['color_hex'] ?? '#000000',
                    'image'      => null,
                ];
                if ($request->hasFile("variants.{$i}.image")) {
                    $v['image'] = $request->file("variants.{$i}.image")->store('products', 'public');
                }
                $variants[] = $v;
            }
        }
        $validated['color_variants'] = $variants;

        $validated['is_new']      = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['on_sale']     = $request->has('on_sale');
        $validated['sizes']       = $request->input('sizes', []);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image)   Storage::disk('public')->delete($product->image);
        if ($product->image_2) Storage::disk('public')->delete($product->image_2);
        if ($product->image_3) Storage::disk('public')->delete($product->image_3);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}