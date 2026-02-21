@extends('layouts.app')

@section('content')
<div class="bg-[#f5f2ed] min-h-screen">

    {{-- Hero Section --}}
    <section class="w-full pt-6 pb-10 px-4 text-center">
        <div class="flex gap-2 text-sm font-light font-serif tracking-wide text-gray-500 mb-6 justify-start max-w-7xl mx-auto px-4">
            <a href="{{ url('/') }}" class="hover:underline">Home /</a>
            <a href="{{ url('/women') }}" class="hover:underline">Women /</a>
            <span class="text-black">{{ ucfirst($category) }} Socks</span>
        </div>
        <h1 class="text-3xl font-serif font-light text-black">Women's {{ ucfirst($category) }} Socks</h1>
        <p class="mt-3 text-sm text-gray-600 max-w-lg mx-auto leading-relaxed">
            Our Trino™ Socks are made from the best materials nature has to offer, like wool and trees. Pair them with our shoes for unbeatable comfort that's even better together.
        </p>
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

    {{-- Product Grid --}}
    <section class="max-w-full px-4 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <x-product-card-socks
                :image="asset('storage/' . $product->image)"
                :title="$product->name"
                :subtitle="$product->color_name ?? 'Various Colors'"
                :price="$product->on_sale ? $product->sale_price : $product->price"
                :link="url('/product/' . $product->slug)"
                :isNew="$product->is_new"
                :onSale="$product->on_sale ?? false"
                :salePrice="$product->sale_price ?? null"
                :colors="$product->color_swatches ?? []">

                {{-- Sizes --}}
                @php
                    $sockSizes = [
                        'S'  => 'W5-7',
                        'M'  => 'W8-10 / M8',
                        'L'  => 'W11 / M9-12',
                        'XL' => 'M13-14',
                    ];
                @endphp
                @foreach($sockSizes as $size => $range)
                    @if($product->sizes && isset($product->sizes[$size]) && $product->sizes[$size] <= 0)
                        <div class="relative h-14 border border-gray-200 rounded-lg flex flex-col items-center justify-center text-gray-300 text-xs select-none overflow-hidden">
                            <span class="font-medium">{{ $size }}</span>
                            <span class="text-[10px]">{{ $range }}</span>
                            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                                <line x1="10%" y1="90%" x2="90%" y2="10%" stroke="#D1D5DB" stroke-width="1" stroke-linecap="round"/>
                            </svg>
                        </div>
                    @else
                        <button class="h-14 border border-gray-200 rounded-lg flex flex-col items-center justify-center
                                       text-black hover:border-black transition-colors duration-150 text-xs font-medium
                                       focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-1">
                            <span class="font-semibold text-[13px]">{{ $size }}</span>
                            <span class="text-[10px] text-gray-400">{{ $range }}</span>
                        </button>
                    @endif
                @endforeach

            </x-product-card-socks>
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