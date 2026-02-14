@extends('layouts.app')

@section('content')
    <div class="max-w-[1200px] mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold mb-10 text-center">Shop All Products</h1>

        @if($products->isEmpty())
            <p class="text-center text-xl text-gray-600 py-20">
                No products added yet.<br>
                Go to admin → add some products!
            </p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img 
                                src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->name }}"
                                class="w-full h-64 object-cover"
                            >
                            @if($product->is_new)
                                <span class="absolute top-3 left-3 bg-black text-white text-xs font-bold px-3 py-1 rounded-full">
                                    NEW
                                </span>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
                            @if($product->price)
                                <p class="text-green-700 font-bold text-xl">
                                    ${{ number_format($product->price, 2) }}
                                </p>
                            @else
                                <p class="text-gray-500">Price not set</p>
                            @endif
                            <p class="text-sm text-gray-600 mt-2">{{ $product->category }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection