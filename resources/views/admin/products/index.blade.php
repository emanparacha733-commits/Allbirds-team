@extends('admin.layout')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Products Management</h2>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-black text-white rounded-lg">
            + Add Product
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4">Image</th>
                    <th class="p-4">Name</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-t">
                    <td class="p-4">
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="p-4">{{ $product->name }}</td>
                    <td class="p-4">${{ $product->price }}</td>
                    <td class="p-4 flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white rounded">
                           Edit
                        </a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-500 text-white rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
