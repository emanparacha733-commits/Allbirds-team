@extends('admin.layout')
@section('title', 'All Products')
@section('content')
    <h1 class="text-xl font-bold mb-4">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-2 inline-block">Add Product</a>
    <table class="w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Name</th>
                <th class="p-2">Image</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-b">
                <td class="p-2">{{ $product->id }}</td>
                <td class="p-2">{{ $product->name }}</td>
                <td class="p-2"><img src="{{ asset('storage/'.$product->image) }}" class="w-16 h-16"></td>
                <td class="p-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
