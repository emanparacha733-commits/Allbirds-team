@extends('layouts.app')

@section('content')
<div class="bg-[#f5f2ed] min-h-screen">

    {{-- Hero Section --}}
    <section class="relative w-full h-[50vh] md:h-[60vh] bg-cover bg-center rounded-2xl" 
             style="background-image: url('/images/sale-hero-women.webp');">
        <div class="relative z-10 max-w-7xl mx-auto h-full flex flex-col justify-between md:px-8 text-white">
            <div class="flex gap-6 text-sm font-light font-serif tracking-wide mt-12">
                <a href="{{ url('/') }}" class="hover:underline">Home/</a>
                <a href="{{ url('/sale') }}" class="hover:underline">Sale/</a>
                <a href="#" class="hover:underline">Women's Shoes</a>
            </div>
            <p class="max-w-xl text-3xl md:text-2xl font-medium font-serif lg:mb-8 leading-tight mb-12 md:mb-16 sm:text-sm">
                Women's Shoes on Sale
            </p>
        </div>
    </section>

    {{-- Filter Bar --}}
    <div class="w-full max-w-6xl mx-auto px-6 py-4 flex items-center justify-between bg-[#E6DDD0] rounded-[40px] mt-4">
        <div class="flex items-center gap-4">
            <button class="flex items-center gap-2 text-black text-sm font-medium hover:opacity-70 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707v6.172a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6.172a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                FILTER
            </button>
            @php
                $saleCount = \App\Models\Product::where('type', 'shoes')
                                                ->where('gender', 'women')
                                                ->where('on_sale', true)
                                                ->count();
            @endphp
            <span class="text-gray-600 text-sm">({{ $saleCount }} products)</span>
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center bg-[#E5DFD6] border border-[#D4CDC3] rounded-full p-[4px]">
                <a href="{{ url('/sale/men/shoes') }}" class="px-6 py-1.5 rounded-full text-[13px] font-medium transition text-black">MEN</a>
                <a href="{{ url('/sale/women/shoes') }}" class="px-6 py-1.5 rounded-full text-[13px] font-medium transition bg-black text-white">WOMEN</a>
            </div>

            <div class="relative inline-block">
                <button id="sortBtn" class="flex items-center gap-2 px-6 py-2 bg-[#E5DFD6] border border-[#D4CDC3] rounded-full text-[13px] font-medium text-black hover:opacity-80 transition">
                    BEST SELLING
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" id="arrowIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-44 bg-black rounded-xl hidden z-30">
                    <a href="?sort=price_low" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Price: Low to High</a>
                    <a href="?sort=price_high" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Price: High to Low</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Grid --}}
    <section class="max-w-full px-4 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @php
            $products = \App\Models\Product::where('type', 'shoes')
                                          ->where('gender', 'women')
                                          ->where('on_sale', true)
                                          ->get();
        @endphp

        @forelse($products as $product)
        <div class="relative group bg-white p-6 pt-10 h-[420px] rounded-2xl shadow-2xl transition-all hover:h-[520px] hover:-translate-y-2">
            <span class="absolute top-4 left-4 bg-red-500 text-white text-xs px-3 py-1 rounded-full font-semibold">SALE</span>
            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover rounded-xl" alt="{{ $product->name }}" />
            <h4 class="mt-20 text-sm font-semibold">{{ strtoupper($product->name) }}</h4>
            <p class="text-black font-semibold">
                <span class="text-red-600">${{ number_format($product->sale_price, 0) }}</span>
                <span class="text-gray-400 line-through ml-2 text-xs">${{ number_format($product->price, 0) }}</span>
            </p>

            <div class="mt-4 opacity-0 group-hover:opacity-100">
                <div class="grid grid-cols-5 gap-2">
                    @foreach(['5', '6', '7', '8', '9', '10'] as $size)
                        <button class="h-10 border border-gray-300 rounded-md text-xs hover:bg-gray-100">{{ $size }}</button>
                    @endforeach
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 text-gray-500">No women's shoes on sale.</div>
        @endforelse
    </section>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("sortBtn");
    const menu = document.getElementById("dropdownMenu");
    const arrow = document.getElementById("arrowIcon");
    btn.onclick = () => { menu.classList.toggle("hidden"); arrow.classList.toggle("rotate-180"); };
});
</script>
@endsection