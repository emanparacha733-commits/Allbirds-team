@extends('layouts.admin.layout')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <!-- Stats cards -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Total Products</p>
        <p class="text-3xl font-bold text-black">{{ $totalProducts }}</p>
        <p class="text-xs text-gray-400 mt-1">In your store</p>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Total Orders</p>
        <p class="text-3xl font-bold text-black">{{ $totalOrders }}</p>
        <p class="text-xs text-gray-400 mt-1">All time</p>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Revenue</p>
        <p class="text-3xl font-bold text-black">${{ number_format($totalRevenue, 0) }}</p>
        <p class="text-xs text-gray-400 mt-1">All time</p>
    </div>
</div>

<!-- Recent Products Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-gray-800">Recent Products</h2>
        <a href="{{ route('admin.products.create') }}"
           class="text-xs bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800 transition">
            + Add Product
        </a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Product</th>
                <th class="px-6 py-3 text-left">Type</th>
                <th class="px-6 py-3 text-left">Gender</th>
                <th class="px-6 py-3 text-left">Price</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($recentProducts as $product)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ $product->image_url }}" class="w-10 h-10 rounded-lg object-cover">
                        <span class="font-medium text-gray-900">{{ $product->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500 capitalize">{{ $product->type }}</td>
                <td class="px-6 py-4 text-gray-500 capitalize">{{ $product->gender }}</td>
                <td class="px-6 py-4 text-gray-900 font-medium">${{ number_format($product->price, 0) }}</td>
                <td class="px-6 py-4">
                    @if($product->is_new)
                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">New</span>
                    @elseif($product->on_sale)
                    <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">Sale</span>
                    @else
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Active</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="text-xs text-gray-500 hover:text-black border border-gray-200 px-3 py-1.5 rounded-lg hover:border-black transition">
                            Edit
                        </a>
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection