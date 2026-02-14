@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6">Add New Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label>Product Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label>Category</label>
            <select name="category" class="w-full border px-3 py-2 rounded" required>
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="socks">Socks</option>
                <option value="apparel">Apparel</option>
            </select>
        </div>
        <div>
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="w-full border px-3 py-2 rounded">
        </div>
        <div>
            <label>Image</label>
            <input type="file" name="image" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label>
                <input type="checkbox" name="is_new"> Mark as New
            </label>
        </div>
        <button type="submit" class="bg-black text-white px-6 py-2 rounded">Add Product</button>
    </form>
</div>
@endsection
