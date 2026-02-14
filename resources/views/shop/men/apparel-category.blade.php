@extends('layouts.app')

@section('content')
<div class="bg-[#f5f4f0] min-h-screen">
    <!-- Top Announcement Bar -->
    <div class="bg-[#2b2b2b] text-white text-center py-2 text-sm">
        <span>Shop New Arrivals. </span>
        <a href="{{ route('men.index') }}" class="underline hover:no-underline">Shop Men</a>
        <span> | </span>
        <a href="{{ route('women.index') }}" class="underline hover:no-underline">Shop Women</a>
    </div>

    <!-- Breadcrumb -->
    <div class="max-w-[1400px] mx-auto px-6 py-4">
        <nav class="text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('men.index') }}" class="hover:underline">Mens</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">Men's Tops</span>
        </nav>
    </div>

    <!-- Page Header -->
    <div class="max-w-[1400px] mx-auto px-6 py-8 text-center">
        <h1 class="text-4xl md:text-5xl font-normal mb-4" style="font-family: 'Georgia', serif;">Men's Tops</h1>
        <p class="text-gray-700 max-w-3xl mx-auto leading-relaxed">
            Crafted from soft, airy, natural materials like organic cotton and our breathable Tree Knit, these tees offer exceptional comfort.
        </p>
    </div>

    <!-- Filter Bar -->
    <div class="max-w-[1400px] mx-auto px-6 mb-8">
        <div class="bg-[#e8e6df] rounded-full p-2 flex items-center justify-between">
            <!-- Left: Filter Button -->
            <button class="flex items-center gap-2 px-6 py-3 hover:bg-white/50 rounded-full transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
                <span class="font-semibold text-sm uppercase tracking-wide">Filter</span>
                <span class="text-gray-600 text-sm">({{ $products->count() }} products)</span>
            </button>

            <!-- Right: Gender & Sort -->
            <div class="flex items-center gap-3">
                <!-- Gender Toggle -->
                <div class="flex bg-white rounded-full p-1">
                    <button class="px-6 py-2 bg-black text-white rounded-full text-sm font-semibold uppercase tracking-wide">
                        MEN
                    </button>
                    <button class="px-6 py-2 text-gray-700 rounded-full text-sm font-semibold uppercase tracking-wide hover:bg-gray-100 transition">
                        WOMEN
                    </button>
                </div>

                <!-- Sort Dropdown -->
                <div class="relative">
                    <button class="flex items-center gap-3 px-6 py-3 bg-white rounded-full text-sm font-semibold uppercase tracking-wide hover:bg-gray-50 transition">
                        <span>FEATURED</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-[1400px] mx-auto px-6 pb-16">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-12">
                @foreach($products as $product)
                    <div class="group">
                        <a href="{{ route('products.show', $product->slug) }}" class="block">
                            <!-- Product Image -->
                            <div class="aspect-[3/4] bg-white rounded-2xl overflow-hidden mb-4 relative">
                                @if($product->image)
                                    <img 
                                        src="{{ asset('storage/' . $product->image) }}" 
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Quick Add Button (shows on hover) -->
                                <div class="absolute bottom-4 left-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <button class="w-full bg-white text-black py-3 rounded-full font-semibold text-sm uppercase tracking-wide hover:bg-gray-100 transition">
                                        Quick Add
                                    </button>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="text-center">
                                <h3 class="font-semibold text-sm uppercase tracking-wide mb-1">
                                    {{ $product->name }}
                                </h3>
                                
                                <!-- Price -->
                                <div class="flex items-center justify-center gap-2 mb-1">
                                    @if($product->sale_price)
                                        <span class="text-red-600 font-semibold">${{ number_format($product->sale_price, 2) }}</span>
                                        <span class="text-gray-400 line-through text-sm">${{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="font-semibold">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>

                                <!-- Color/Variant Info -->
                                @if($product->color)
                                    <p class="text-xs text-gray-500">{{ $product->color }}</p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h2 class="text-3xl font-normal mb-3" style="font-family: 'Georgia', serif;">No Products Found</h2>
                <p class="text-gray-600 mb-8">We don't have any {{ $category }} available right now.</p>
                <a href="{{ route('men.apparel') }}" class="inline-block bg-black text-white px-8 py-4 rounded-full font-semibold text-sm uppercase tracking-wide hover:bg-gray-800 transition">
                    Browse All Apparel
                </a>
            </div>
        @endif
    </div>

    <!-- Chat Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button class="bg-black text-white px-6 py-3 rounded-full font-semibold text-sm shadow-lg hover:bg-gray-800 transition">
            Chat
        </button>
    </div>
</div>
@endsection