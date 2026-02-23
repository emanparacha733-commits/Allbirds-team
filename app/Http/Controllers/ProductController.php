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

        $view = in_array($product->type, ['socks', 'apparel'])
            ? 'shop.men.detailsocks'
            : 'shop.men.detailshoes';

        return view($view, compact('product', 'relatedProducts'));
    }

    public function create()
    {
        return view('layouts.admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_2'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_3'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category'    => 'required|string',
            'type'        => 'required|in:shoes,socks,apparel,accessories',
            'gender'      => 'required|in:men,women,unisex',
            'price'       => 'required|numeric|min:0',
            'sale_price'  => 'nullable|numeric|min:0',
            'sizes'       => 'nullable|array',
        ]);

        $data = $request->only(['name','description','category','type','gender','price','sale_price']);

        $data['image'] = $request->file('image')->store('products', 'public');
        if ($request->hasFile('image_2')) $data['image_2'] = $request->file('image_2')->store('products', 'public');
        if ($request->hasFile('image_3')) $data['image_3'] = $request->file('image_3')->store('products', 'public');

        $variants = [];
        foreach ($request->input('variants', []) as $i => $variant) {
            if (empty($variant['color_name'])) continue;
            $v = [
                'color_name' => $variant['color_name'],
                'color_hex'  => $variant['color_hex'] ?? '#000000',
                'image'      => null,
                'image_2'    => null,
            ];
            if ($request->hasFile("variants.{$i}.image")) {
                $v['image'] = $request->file("variants.{$i}.image")->store('products/variants', 'public');
            }
            if ($request->hasFile("variants.{$i}.image_2")) {
                $v['image_2'] = $request->file("variants.{$i}.image_2")->store('products/variants', 'public');
            }
            $variants[] = $v;
        }
        $data['color_variants'] = $variants;
        $data['color_name']     = $variants[0]['color_name'] ?? null;
        $data['color_hex']      = $variants[0]['color_hex']  ?? null;

        $data['is_new']      = $request->has('is_new');
        $data['is_featured'] = $request->has('is_featured');
        $data['on_sale']     = $request->has('on_sale');
        $data['sizes']       = $request->input('sizes', []);

        Product::create($data);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        return view('layouts.admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_2'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_3'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category'    => 'required|string',
            'type'        => 'required|in:shoes,socks,apparel,accessories',
            'gender'      => 'required|in:men,women,unisex',
            'price'       => 'required|numeric|min:0',
            'sale_price'  => 'nullable|numeric|min:0',
            'sizes'       => 'nullable|array',
        ]);

        // ── Main product images ───────────────────────────────────────────────
        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $product->image = $request->file('image')->store('products', 'public');
        }
        if ($request->hasFile('image_2')) {
            if ($product->image_2) Storage::disk('public')->delete($product->image_2);
            $product->image_2 = $request->file('image_2')->store('products', 'public');
        }
        if ($request->hasFile('image_3')) {
            if ($product->image_3) Storage::disk('public')->delete($product->image_3);
            $product->image_3 = $request->file('image_3')->store('products', 'public');
        }

        // ── Variants ─────────────────────────────────────────────────────────
        // FIX: Use the hidden 'existing_image' fields from the form as the source
        // of truth instead of matching by array index against $existingVariants.
        // The old approach broke when variants were reordered or removed.
        $newVariants = [];
        foreach ($request->input('variants', []) as $i => $variantData) {
            if (empty($variantData['color_name'])) continue;

            // Image 1 — use hidden field value (set in the edit form blade)
            $img1 = $variantData['existing_image'] ?? null;
            if ($request->hasFile("variants.{$i}.image")) {
                // Delete the old file only if we had one
                if ($img1) Storage::disk('public')->delete($img1);
                $img1 = $request->file("variants.{$i}.image")->store('products/variants', 'public');
            }

            // Image 2 — use hidden field value (set in the edit form blade)
            $img2 = $variantData['existing_image_2'] ?? null;
            if ($request->hasFile("variants.{$i}.image_2")) {
                if ($img2) Storage::disk('public')->delete($img2);
                $img2 = $request->file("variants.{$i}.image_2")->store('products/variants', 'public');
            }

            $newVariants[] = [
                'color_name' => $variantData['color_name'],
                'color_hex'  => $variantData['color_hex'] ?? '#000000',
                'image'      => $img1,
                'image_2'    => $img2,
            ];
        }

        // ── Sizes ─────────────────────────────────────────────────────────────
        $sizes = [];
        foreach ($request->input('sizes', []) as $size => $qty) {
            $sizes[$size] = (int) $qty;
        }

        // ── Persist ───────────────────────────────────────────────────────────
        $product->update([
            'name'           => $request->name,
            'description'    => $request->description,
            'type'           => $request->type,
            'gender'         => $request->gender,
            'category'       => $request->category,
            'price'          => $request->price,
            'sale_price'     => $request->sale_price,
            'is_new'         => $request->has('is_new'),
            'is_featured'    => $request->has('is_featured'),
            'on_sale'        => $request->has('on_sale'),
            'sizes'          => $sizes,
            'color_variants' => $newVariants,
            'color_name'     => $newVariants[0]['color_name'] ?? $product->color_name,
            'color_hex'      => $newVariants[0]['color_hex']  ?? $product->color_hex,
            'image'          => $product->image,
            'image_2'        => $product->image_2,
            'image_3'        => $product->image_3,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image)   Storage::disk('public')->delete($product->image);
        if ($product->image_2) Storage::disk('public')->delete($product->image_2);
        if ($product->image_3) Storage::disk('public')->delete($product->image_3);

        $variants = $product->color_variants;
        if (is_string($variants)) $variants = json_decode($variants, true) ?? [];
        if (is_array($variants)) {
            foreach ($variants as $v) {
                if (!empty($v['image']))   Storage::disk('public')->delete($v['image']);
                if (!empty($v['image_2'])) Storage::disk('public')->delete($v['image_2']);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}