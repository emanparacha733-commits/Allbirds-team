@extends('layouts.admin')
@section('title', 'Products')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-900">All Products</h2>
        <p class="text-sm text-gray-400 mt-0.5">{{ $products->count() }} products total</p>
    </div>
    <a href="{{ route('admin.products.create') }}"
       class="bg-black text-white text-sm px-5 py-2.5 rounded-full hover:bg-gray-800 transition font-medium">
        + Add Product
    </a>
</div>

@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Product</th>
                <th class="px-6 py-3 text-left">Category</th>
                <th class="px-6 py-3 text-left">Gender</th>
                <th class="px-6 py-3 text-left">Price</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($products as $product)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ $product->image_url }}" class="w-12 h-12 rounded-xl object-cover border border-gray-100">
                        <div>
                            <p class="font-medium text-gray-900">{{ $product->name }}</p>
                            <p class="text-xs text-gray-400">{{ $product->color_name }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500 capitalize">{{ $product->type }} / {{ $product->category }}</td>
                <td class="px-6 py-4 text-gray-500 capitalize">{{ $product->gender }}</td>
                <td class="px-6 py-4">
                    @if($product->on_sale && $product->sale_price)
                    <span class="text-red-600 font-medium">${{ number_format($product->sale_price, 0) }}</span>
                    <span class="text-gray-400 line-through text-xs ml-1">${{ number_format($product->price, 0) }}</span>
                    @else
                    <span class="font-medium">${{ number_format($product->price, 0) }}</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-1 flex-wrap">
                        @if($product->is_new)
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">New</span>
                        @endif
                        @if($product->on_sale)
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full">Sale</span>
                        @endif
                        @if($product->is_featured)
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">Featured</span>
                        @endif
                        @if(!$product->is_new && !$product->on_sale && !$product->is_featured)
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Active</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        {{-- View --}}
                        <a href="{{ route('products.show', $product->id) }}" target="_blank"
                           class="text-xs text-gray-500 hover:text-black border border-gray-200 px-3 py-1.5 rounded-lg hover:border-black transition">
                            View
                        </a>
                        {{-- Edit --}}
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="text-xs text-gray-500 hover:text-black border border-gray-200 px-3 py-1.5 rounded-lg hover:border-black transition">
                            Edit
                        </a>
                        {{-- Delete --}}
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Delete {{ $product->name }}? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-xs text-red-400 hover:text-red-600 border border-red-100 hover:border-red-300 px-3 py-1.5 rounded-lg transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                    <p class="text-lg">No products yet</p>
                    <a href="{{ route('admin.products.create') }}" class="text-sm text-black underline mt-2 inline-block">Add your first product</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection