@extends('layouts.app')

@section('content')


    <!-- Page Header -->
    <div class="max-w-[1400px] mx-auto px-6 py-8 text-center">
        <h1 class="text-4xl md:text-5xl font-normal mb-4" style="font-family: 'Georgia', serif;">
            Men's {{ ucfirst($category) }}
        </h1>
        <p class="text-gray-700 max-w-3xl mx-auto leading-relaxed">
            Crafted from soft, airy, natural materials like organic cotton and our breathable Tree Knit, these pieces offer exceptional comfort.
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
                    <a href="{{ url('/men/apparel/' . $category) }}" 
                       class="px-6 py-2 {{ request()->is('men/apparel/*') ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-100' }} rounded-full text-sm font-semibold uppercase tracking-wide transition">
                        MEN
                    </a>
                    <a href="{{ url('/women/apparel/' . $category) }}"
                       class="px-6 py-2 {{ request()->is('women/apparel/*') ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-100' }} rounded-full text-sm font-semibold uppercase tracking-wide transition">
                        WOMEN
                    </a>
                </div>

                <!-- Sort Dropdown -->
                <div class="relative">
                    <button id="sortBtn" class="flex items-center gap-3 px-6 py-3 bg-white rounded-full text-sm font-semibold uppercase tracking-wide hover:bg-gray-50 transition">
                        <span>FEATURED</span>
                        <svg class="w-4 h-4 transition-transform duration-200" id="arrowIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div id="dropdownMenu" class="absolute right-0 mt-2 w-56 bg-black border border-gray-700 rounded-xl shadow-lg hidden z-30">
                        <a href="?sort=featured" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">FEATURED</a>
                        <a href="?sort=best_selling" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">BEST SELLING</a>
                        <a href="?sort=alpha_asc" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">ALPHABETICALLY, A-Z</a>
                        <a href="?sort=alpha_desc" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">ALPHABETICALLY, Z-A</a>
                        <a href="?sort=price_low" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">PRICE, LOW TO HIGH</a>
                        <a href="?sort=price_high" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">PRICE, HIGH TO LOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid with Shoes-Style Animation -->
    <div class="max-w-[1400px] mx-auto px-6 pb-16">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="relative group w-full block bg-white p-6 pt-10 h-[520px] rounded-2xl shadow-2xl overflow-hidden cursor-pointer
           transition-all duration-300 ease-out hover:h-[620px] hover:-translate-y-2">

                        @if($product->is_new)
                        <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full z-10">
                            NEW
                        </span>
                        @endif

                        <!-- Product Image -->
                        @if($product->image)
                            <img 
                                src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->name }}"
                                class="w-full h-48 object-cover rounded-xl"
                            >
                        @else
                            <div class="w-full h-48 flex items-center justify-center bg-gray-100 text-gray-400 rounded-xl">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif

                        <!-- Product Info -->
                        <h4 class="mt-20 text-sm font-semibold text-black">
                            {{ strtoupper($product->name) }}
                        </h4>
                        
                        <!-- Color -->
                        @if($product->color_name)
                            <p class="text-gray-500 text-sm">{{ $product->color_name }}</p>
                        @endif

                        <!-- Price -->
                        <p class="text-black font-semibold">
                            @if($product->sale_price)
                                <span class="text-red-600">${{ number_format($product->sale_price, 0) }}</span>
                                <span class="text-gray-400 line-through ml-2 text-xs">${{ number_format($product->price, 0) }}</span>
                            @else
                                ${{ number_format($product->price, 0) }}
                            @endif
                        </p>

                        <!-- Sizes (shows on hover) -->
                        <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <div class="grid grid-cols-4 gap-2">
                                @php
                                    $apparelSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
                                @endphp
                                @foreach($apparelSizes as $size)
                                    @if($product->sizes && isset($product->sizes[$size]) && $product->sizes[$size] <= 0)
                                        <div class="relative h-10 border border-gray-300 rounded-md flex items-center justify-center text-gray-400 text-xs">
                                            {{ $size }}
                                            <span class="absolute w-4/5 h-[1px] bg-gray-300 rotate-[-15deg]"></span>
                                        </div>
                                    @else
                                        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center text-black hover:bg-gray-100 text-xs cursor-pointer">
                                            {{ $size }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
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

    <!-- Dropdown JS -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.getElementById("sortBtn");
        const menu = document.getElementById("dropdownMenu");
        const arrow = document.getElementById("arrowIcon");

        btn.addEventListener("click", function () {
            menu.classList.toggle("hidden");
            arrow.classList.toggle("rotate-180");
        });

        document.addEventListener("click", function (e) {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add("hidden");
                arrow.classList.remove("rotate-180");
            }
        });
    });
    </script>
</div>
@endsection