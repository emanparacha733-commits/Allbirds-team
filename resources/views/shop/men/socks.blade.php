@extends('layouts.app')

@section('content')
<div class="bg-[#f5f2ed] min-h-screen overflow-visible">

    {{-- Hero Section --}}
    <section class="w-full pt-6 pb-10 px-4 text-center">
        <div class="flex gap-2 text-sm font-light font-serif tracking-wide text-gray-500 mb-6 justify-start max-w-7xl mx-auto px-4">
            <a href="{{ url('/') }}" class="hover:underline">Home /</a>
            <a href="{{ url('/men') }}" class="hover:underline">Men /</a>
            <span class="text-black">Socks</span>
        </div>
        <h1 class="text-3xl font-serif font-light text-black">Men's Socks</h1>
        <p class="mt-3 text-sm text-gray-600 max-w-lg mx-auto leading-relaxed">
            Our Trino™ Socks are made from the best materials nature has to offer, like wool and trees. Pair them with our shoes for unbeatable comfort that's even better together.
        </p>
    </section>

    {{-- Filter Bar --}}
    <div class="w-full max-w-6xl mx-auto px-6 py-4 flex items-center justify-between bg-[#E6DDD0] rounded-[40px] mt-4">
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
        <div class="flex items-center gap-4">
            <div class="flex items-center bg-[#E5DFD6] border border-[#D4CDC3] rounded-full p-[4px]">
                <a href="{{ url('/men/socks') }}"
                   class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
                   {{ request()->is('men/socks*') ? 'bg-black text-white' : 'text-black' }}">
                   MEN
                </a>
                <a href="{{ url('/women/socks') }}"
                   class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
                   {{ request()->is('women/socks*') ? 'bg-black text-white' : 'text-black' }}">
                   WOMEN
                </a>
            </div>
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

    {{-- ↓ ONLY CHANGE: section → div --}}
    <div class="relative max-w-full px-4 pt-6 pb-32 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 items-start overflow-visible">
        @forelse($products as $product)
            <x-product-card-socks
                :image="asset('storage/' . $product->image)"
                :title="$product->name"
                :subtitle="$product->color_name ?? 'Various Colors'"
                :price="$product->on_sale ? $product->sale_price : $product->price"
                :link="route('products.show', $product->id)"
                :isNew="$product->is_new"
                :onSale="$product->on_sale ?? false"
                :salePrice="$product->sale_price ?? null"
                :colors="$product->color_swatches ?? []">

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
                        <div class="relative h-14 border border-gray-200 rounded-lg flex flex-col items-center justify-center text-gray-300 text-xs">
                            <span class="font-medium">{{ $size }}</span>
                            <span class="text-[10px]">{{ $range }}</span>
                            <span class="absolute w-4/5 h-[1px] bg-gray-200 rotate-[-15deg]"></span>
                        </div>
                    @else
                        <button class="h-14 border border-gray-300 rounded-lg flex flex-col items-center justify-center text-black hover:bg-gray-50 hover:border-black transition text-xs font-medium">
                            <span class="font-semibold text-[13px]">{{ $size }}</span>
                            <span class="text-[10px] text-gray-500">{{ $range }}</span>
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
    </div>
    {{-- ↑ ONLY CHANGE: /section → /div --}}

    {{-- Bottom Category Cards --}}
    <section class="w-full px-2 sm:px-4 lg:px-6 py-6 grid
                    grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3
                    gap-2 sm:gap-4 md:gap-6 lg:gap-4">
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
                             hover:bg-white hover:text-black transition">Shop Men</button>
                <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                             flex items-center justify-center w-40 h-[5vh]
                             hover:bg-white hover:text-black transition">Shop Women</button>
            </div>
        </div>
        @endforeach
    </section>

    {{-- Info Cards --}}
    <section class="max-w-full px-6 py-8 mx-auto grid
                    grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4">
            <p class="text-xl text-black">Wear All Day Comfort</p>
            <p class="text-gray-600 text-sm">Lightweight, bouncy, and wildly comfortable, Allbirds socks make any outing feel effortless.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4">
            <p class="text-xl text-black">Sustainability In Every Step</p>
            <p class="text-gray-600 text-sm">From materials to transport, we're working to reduce our carbon footprint to near zero.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4">
            <p class="text-xl text-black">Materials From The Earth</p>
            <p class="text-gray-600 text-sm">We replace petroleum-based synthetics with natural alternatives wherever we can.</p>
        </div>
    </section>

</div>

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