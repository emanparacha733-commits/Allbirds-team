@extends('layouts.app')

@section('content')
<div class="bg-[#f5f2ed] min-h-screen">

    {{-- Hero Section --}}
    <section class="relative w-full h-[50vh] md:h-[60vh] bg-cover bg-center rounded-2xl" 
             style="background-image: url('/images/socks-hero.webp');">
        <div class="relative z-10 max-w-7xl mx-auto h-full flex flex-col justify-between md:px-8 text-white">
            
            {{-- Breadcrumb --}}
            <div class="flex gap-6 text-sm font-light font-serif tracking-wide mt-12">
                <a href="{{ url('/') }}" class="hover:underline">Home/</a>
                <a href="{{ url('/men') }}" class="hover:underline">Men/</a>
                <a href="#" class="hover:underline">{{ ucfirst($category) }} Socks</a>
            </div>

            {{-- Title --}}
            <p class="max-w-xl text-3xl md:text-2xl font-medium font-serif lg:mb-8 leading-tight mb-12 md:mb-16 sm:text-sm">
                Men's {{ ucfirst($category) }} Socks
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
            <span class="text-gray-600 text-sm">({{ $products->count() }} products)</span>
        </div>

        {{-- Right: Switch + Dropdown --}}
        <div class="flex items-center gap-4">
            {{-- MEN / WOMEN Switch --}}
            <div class="flex items-center bg-[#E5DFD6] border border-[#D4CDC3] rounded-full p-[4px]">
                <a href="{{ url('/men/socks/' . $category) }}"
                   class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
                   {{ request()->is('men/socks/*') ? 'bg-black text-white' : 'text-black' }}">
                   MEN
                </a>
                <a href="{{ url('/women/socks/' . $category) }}"
                   class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
                   {{ request()->is('women/socks/*') ? 'bg-black text-white' : 'text-black' }}">
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
                </div>
            </div>
        </div>
    </div>

    {{-- Product Grid Using ProductCard Component --}}
    <section class="max-w-full px-4 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <x-product-card 
                :image="asset('storage/' . $product->image)" 
                :title="$product->name" 
                :subtitle="$product->color_name ?? 'Various Colors'" 
                :price="$product->on_sale ? $product->sale_price : $product->price" 
                :link="url('/product/' . $product->slug)"
                :isNew="$product->is_new">
                
                {{-- Sizes --}}
                <div class="grid grid-cols-5 gap-2">
                    @php
                        $sockSizes = ['S','M','L','XL'];
                    @endphp
                    @foreach($sockSizes as $size)
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
            </x-product-card>
        @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 text-lg">No products found in this category.</p>
                <a href="{{ url('/admin/products/create') }}" 
                   class="inline-block mt-4 px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                    Add Products
                </a>
            </div>
        @endforelse
    </section>

    {{-- Bottom Category Cards --}}
    <x-product-grid :products="$categories ?? []"/>
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

    document.addEventListener("click", function (e) {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
            arrow.classList.remove("rotate-180");
        }
    });
});
</script>
@endsection
