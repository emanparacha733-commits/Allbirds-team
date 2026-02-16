@extends('layouts.app')

@section('content')
<div class="bg-[#f5f2ed] min-h-screen">

    {{-- Hero Section --}}
    <section class="relative w-full h-[50vh] md:h-[60vh] bg-cover bg-center rounded-2xl" 
             style="background-image: url('/images/sale-hero.webp');">
        <div class="relative z-10 max-w-7xl mx-auto h-full flex flex-col justify-between md:px-8 text-white">
            
            {{-- Breadcrumb --}}
            <div class="flex gap-6 text-sm font-light font-serif tracking-wide mt-12">
                <a href="{{ url('/') }}" class="hover:underline">Home/</a>
                <a href="{{ url('/sale') }}" class="hover:underline">Sale/</a>
                <a href="#" class="hover:underline">Men's Shoes</a>
            </div>

            {{-- Title --}}
            <p class="max-w-xl text-3xl md:text-2xl font-medium font-serif lg:mb-8 leading-tight mb-12 md:mb-16 sm:text-sm">
                Men's Shoes on Sale
            </p>
        </div>
    </section>

    {{-- Filter Bar --}}
    <div class="w-full max-w-6xl mx-auto px-6 py-4 flex items-center justify-between bg-[#E6DDD0] rounded-[40px] mt-4">
        
        {{-- Left: Filter + Count --}}
        <div class="flex items-center gap-4">
            <button class="flex items-center gap-2 text-black text-sm font-medium hover:opacity-70 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707v6.172a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6.172a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                FILTER
            </button>
            @php
                $saleCount = \App\Models\Product::where('type', 'shoes')
                                                ->where('gender', 'men')
                                                ->where('on_sale', true)
                                                ->count();
            @endphp
            <span class="text-gray-600 text-sm">({{ $saleCount }} products)</span>
        </div>

        {{-- Right: Switch + Dropdown --}}
        <div class="flex items-center gap-4">
            
            {{-- MEN / WOMEN Switch --}}
            <div class="flex items-center bg-[#E5DFD6] border border-[#D4CDC3] rounded-full p-[4px]">
                <a href="{{ url('/sale/men/shoes') }}"
                   class="px-6 py-1.5 rounded-full text-[13px] font-medium transition bg-black text-white">
                   MEN
                </a>
                <a href="{{ url('/sale/women/shoes') }}"
                   class="px-6 py-1.5 rounded-full text-[13px] font-medium transition text-black">
                   WOMEN
                </a>
            </div>

            {{-- Sort Dropdown --}}
            <div class="relative inline-block">
                <button id="sortBtn"
                    class="flex items-center gap-2 px-6 py-2 bg-[#E5DFD6] border border-[#D4CDC3] rounded-full text-[13px] font-medium text-black hover:opacity-80 transition">
                    BEST SELLING
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" id="arrowIcon"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="dropdownMenu"
                    class="absolute right-0 mt-2 w-44 bg-black border border-blue-700 rounded-xl shadow-lg hidden z-30">
                    <a href="?sort=featured" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">FEATURED</a>
                    <a href="?sort=best_selling" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">BEST SELLING</a>
                    <a href="?sort=alpha_asc" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">ALPHABETICALLY, A-Z</a>
                    <a href="?sort=alpha_desc" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">ALPHABETICALLY, Z-A</a>
                    <a href="?sort=price_low" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">PRICE, LOW TO HIGH</a>
                    <a href="?sort=price_high" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">PRICE, HIGH TO LOW</a>
                    <a href="?sort=discount" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">BIGGEST DISCOUNT</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Grid with Shoes-Style Animation --}}
    <section class="max-w-full px-4 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
        
        @php
            $products = \App\Models\Product::where('type', 'shoes')
                                          ->where('gender', 'men')
                                          ->where('on_sale', true)
                                          ->whereNotNull('sale_price')
                                          ->orderBy('sales_count', 'desc')
                                          ->get();
        @endphp

        @forelse($products as $product)
        <div class="relative group w-full block bg-white p-6 pt-10 h-[420px] rounded-2xl shadow-2xl overflow-hidden cursor-pointer
                   transition-all duration-300 ease-out hover:h-[520px] hover:-translate-y-2">

            {{-- SALE tag --}}
            <span class="absolute top-4 left-4 bg-red-500 text-white text-xs px-3 py-1 rounded-full z-10 font-semibold">
                SALE
            </span>

            {{-- Discount Badge --}}
            @if($product->discount_percentage)
            <span class="absolute top-4 right-4 bg-orange-500 text-white text-xs px-2 py-1 rounded-full z-10 font-bold">
                -{{ $product->discount_percentage }}%
            </span>
            @endif

            {{-- Product Image --}}
            <img src="{{ asset('storage/' . $product->image) }}" 
                 class="w-full h-48 object-cover rounded-xl" 
                 alt="{{ $product->name }}" />

            {{-- Product Info --}}
            <h4 class="mt-20 text-sm font-semibold text-black">
                {{ strtoupper($product->name) }}
            </h4>
            <p class="text-gray-500 text-sm">{{ $product->color_name ?? 'Various Colors' }}</p>
            <p class="text-black font-semibold">
                <span class="text-red-600">${{ number_format($product->sale_price, 0) }}</span>
                <span class="text-gray-400 line-through ml-2 text-xs">${{ number_format($product->price, 0) }}</span>
            </p>

            {{-- Sizes Section (appears on hover) --}}
            <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <div class="grid grid-cols-5 gap-2">
                    
                    @php
                        $shoeSizes = ['6', '7', '8', '9', '10', '11', '12'];
                    @endphp
                    
                    @foreach($shoeSizes as $size)
                        @if($product->sizes && isset($product->sizes[$size]) && $product->sizes[$size] <= 0)
                            <div class="relative h-10 border border-gray-300 rounded-md flex items-center justify-center text-gray-400 text-xs">
                                {{ $size }}
                                <span class="absolute w-4/5 h-[1px] bg-gray-300 rotate-[-15deg]"></span>
                            </div>
                        @else
                            <button class="h-10 border border-gray-300 rounded-md flex items-center justify-center text-black hover:bg-gray-100 transition text-xs">
                                {{ $size }}
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <p class="text-gray-500 text-lg">No shoes on sale at the moment.</p>
            <a href="{{ url('/men/shoes') }}" 
               class="inline-block mt-4 px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                Browse All Shoes
            </a>
        </div>
        @endforelse

    </section>

    {{-- Bottom Category Cards --}}
    <section class="w-full px-2 sm:px-4 lg:px-6 py-6 grid
                    grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3
                    gap-2 sm:gap-4 md:gap-6 lg:gap-4 mt-12">

        @php
            $categories = [
                ['title' => 'Shoes', 'image' => 'first.webp'],
                ['title' => 'Apparel', 'image' => 'second.webp'],
                ['title' => 'Accessories', 'image' => 'third.webp']
            ];
        @endphp

        @foreach($categories as $cat)
        <div class="relative rounded-2xl overflow-hidden shadow-lg w-full mx-auto cursor-pointer group">
            <img src="{{ asset('images/' . $cat['image']) }}"
                 class="w-full h-[400px] sm:h-[300px] md:h-[350px] lg:h-auto object-cover rounded-2xl
                        transition-transform duration-1000 ease-out group-hover:scale-105" />

            <h1 class="absolute inset-0 flex items-center justify-center
                       text-white text-4xl bg-black/10 font-light font-serif pointer-events-none">
                {{ $cat['title'] }}
            </h1>

            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-4">
                <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                             flex items-center justify-center w-40 h-[5vh]
                             hover:bg-white hover:text-black transition">
                    Shop Men
                </button>
                <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                             flex items-center justify-center w-40 h-[5vh]
                             hover:bg-white hover:text-black transition">
                    Shop Women
                </button>
            </div>
        </div>
        @endforeach

    </section>

    {{-- Info Cards --}}
    <section class="max-w-full px-6 py-8 mx-auto grid 
                    grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 
                    gap-6">

        <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4">
            <p class="text-xl text-black">Wear All Day Comfort</p>
            <p class="text-gray-600 text-sm">
                Lightweight, bouncy, and wildly comfortable, Allbirds shoes make any outing feel effortless.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4">
            <p class="text-xl text-black">Sustainability In Every Step</p>
            <p class="text-gray-600 text-sm">
                From materials to transport, we're working to reduce our carbon footprint to near zero.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4">
            <p class="text-xl text-black">Materials From The Earth</p>
            <p class="text-gray-600 text-sm">
                We replace petroleum-based synthetics with natural alternatives wherever we can.
            </p>
        </div>

    </section>

</div>

{{-- Dropdown Toggle Script --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("sortBtn");
    const menu = document.getElementById("dropdownMenu");
    const arrow = document.getElementById("arrowIcon");

    btn.addEventListener("click", function () {
        menu.classList.toggle("hidden");
        arrow.classList.toggle("rotate-180");
    });

    // Close if clicked outside
    document.addEventListener("click", function (e) {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
            arrow.classList.remove("rotate-180");
        }
    });
});
</script>

@endsection