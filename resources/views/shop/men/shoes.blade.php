<x-layouts>
  @extends('layouts.app')


<section class="relative w-full h-[50vh] md:h-[60vh] bg-cover bg-center rounded-2xl" style="background-image: url('/images/hero1.jpeg');">
    <div class="relative z-10 max-w-7xl mx-auto h-full flex flex-col justify-between md:px-8 text-white">
        <div class="flex gap-6 text-sm font-light font-serif tracking-wide mt-12">
            <a href='/' class="hover:underline">Home/</a>
            <a href='/men/shoes' class="hover:underline">Men/</a>
            <a href='/men/shoes' class="hover:underline">Men's Dasher Nz Collection</a>
        </div>
        <p class="max-w-xl text-3xl md:text-2xl font-medium font-serif lg:mb-8 leading-tight mb-12 md:mb-16 sm:text-sm">
            Men's Dasher NZ Collection
        </p>
    </div>
</section>

{{-- Filter / Sort Bar --}}
<div class="relative z-50 w-full max-w-6xl mx-auto px-6 py-4 flex items-center justify-between bg-[#E6DDD0] rounded-[40px] mt-4">

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
      <a href="{{ url('/men/shoes') }}"
         class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
         {{ request()->is('men/shoes*') ? 'bg-black text-white' : 'text-black' }}">
         MEN
      </a>
      <a href="{{ url('/women/shoes') }}"
         class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
         {{ request()->is('women/shoes*') ? 'bg-black text-white' : 'text-black' }}">
         WOMEN
      </a>
    </div>

    {{-- Sort Dropdown --}}
    <div class="relative inline-block">
      <button id="sortBtn"
        class="flex items-center gap-2 px-6 py-2 bg-[#E5DFD6] border border-[#D4CDC3] rounded-full text-[13px] font-medium text-black hover:opacity-80 transition">
        {{ request('sort') === 'price_low'  ? 'PRICE, LOW TO HIGH'
         : (request('sort') === 'price_high' ? 'PRICE, HIGH TO LOW'
         : (request('sort') === 'alpha_asc'  ? 'ALPHABETICALLY, A–Z'
         : (request('sort') === 'alpha_desc' ? 'ALPHABETICALLY, Z–A'
         : 'BEST SELLING'))) }}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" id="arrowIcon"
          fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      {{-- z-[9999] ensures it floats above all content --}}
      <div id="dropdownMenu"
        class="absolute right-0 mt-2 w-52 bg-black rounded-xl shadow-2xl hidden z-[9999]">
        <a href="?sort=best_selling" class="block px-4 py-2.5 text-sm text-white hover:bg-gray-800 transition rounded-t-xl">BEST SELLING</a>
        <a href="?sort=price_low"    class="block px-4 py-2.5 text-sm text-white hover:bg-gray-800 transition">PRICE, LOW TO HIGH</a>
        <a href="?sort=price_high"   class="block px-4 py-2.5 text-sm text-white hover:bg-gray-800 transition">PRICE, HIGH TO LOW</a>
        <a href="?sort=alpha_asc"    class="block px-4 py-2.5 text-sm text-white hover:bg-gray-800 transition">ALPHABETICALLY, A–Z</a>
        <a href="?sort=alpha_desc"   class="block px-4 py-2.5 text-sm text-white hover:bg-gray-800 transition">ALPHABETICALLY, Z–A</a>
        <a href="?"                  class="block px-4 py-2.5 text-sm text-white hover:bg-gray-800 transition rounded-b-xl">NEWEST</a>
      </div>
    </div>

  </div>
</div>

{{-- Dynamic products only — no hardcoded cards --}}
<x-product-grid>

    @forelse($products as $product)
    <x-product-card
        :image="$product->image_url"
        :title="strtoupper($product->name)"
        :subtitle="$product->description ?? 'Men\'s Shoes'"
        :price="$product->on_sale && $product->sale_price ? number_format($product->sale_price, 0) : number_format($product->price, 0)"
        :link="route('products.show', $product->id)"
    >
        <div class="grid grid-cols-5 gap-2">
            @forelse($product->available_sizes as $size)
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200 text-sm cursor-pointer">
                    {{ $size }}
                </div>
            @empty
                <p class="col-span-5 text-xs text-gray-400 text-center py-2">Sizes not listed</p>
            @endforelse
        </div>
    </x-product-card>
    @empty
        <div class="col-span-full text-center py-20 text-gray-400">
            <p class="text-lg">No products found.</p>
            <p class="text-sm mt-2">Add products from the admin panel to see them here.</p>
        </div>
    @endforelse

</x-product-grid>


<section class="relative z-10 w-full px-2 sm:px-4 lg:px-6 py-6 grid
                grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3
                gap-2 sm:gap-4 md:gap-6 lg:gap-4">

  <div class="relative rounded-2xl overflow-hidden shadow-lg w-full mx-auto cursor-pointer group">
    <img src="{{ asset('images/first.webp') }}"
         class="w-full h-[400px] sm:h-[300px] md:h-[350px] lg:h-auto object-cover rounded-2xl
                transition-transform duration-1000 ease-out group-hover:scale-105" />
    <h1 class="absolute inset-0 flex items-center justify-center text-white text-4xl bg-black/10 font-light font-serif pointer-events-none">Shoes</h1>
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-4">
      <a href="{{ route('men.shoes') }}"
   class="bg-transparent border border-white text-white rounded-2xl shadow-lg 
          flex items-center justify-center w-40 h-[5vh] 
          hover:bg-white hover:text-black transition">
   Shop Men
</a>

<a href="{{ route('women.shoes') }}"
   class="bg-transparent border border-white text-white rounded-2xl shadow-lg 
          flex items-center justify-center w-40 h-[5vh] 
          hover:bg-white hover:text-black transition">
   Shop Women
</a>
    </div>
  </div>

  <div class="relative rounded-2xl overflow-hidden shadow-lg w-full mx-auto cursor-pointer group">
    <img src="{{ asset('images/second.webp') }}"
         class="w-full h-[400px] sm:h-[300px] md:h-[350px] lg:h-auto object-cover rounded-2xl
                transition-transform duration-1000 ease-out group-hover:scale-105" />
    <h1 class="absolute inset-0 flex items-center justify-center text-white text-4xl font-light font-serif bg-black/10 pointer-events-none">Apparel</h1>
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-4">
  <a href="{{ route('men.apparel') }}"
   class="bg-transparent border border-white text-white rounded-2xl shadow-lg 
          flex items-center justify-center w-40 h-[5vh] 
          hover:bg-white hover:text-black transition">
   Shop Men
</a>

<a href="{{ route('women.apparel') }}"
   class="bg-transparent border border-white text-white rounded-2xl shadow-lg 
          flex items-center justify-center w-40 h-[5vh] 
          hover:bg-white hover:text-black transition">
   Shop Women
</a>
    </div>
  </div>

  <div class="relative rounded-2xl overflow-hidden shadow-lg w-full mx-auto cursor-pointer group">
    <img src="{{ asset('images/third.webp') }}"
         class="w-full h-[400px] sm:h-[300px] md:h-[350px] lg:h-auto object-cover rounded-2xl
                transition-transform duration-1000 ease-out group-hover:scale-105" />
    <h1 class="absolute inset-0 flex items-center justify-center text-white text-4xl font-light font-serif bg-black/10 pointer-events-none">Accessories</h1>
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-4">
     <a href="{{ route('men.shoes') }}"
   class="bg-transparent border border-white text-white rounded-2xl shadow-lg 
          flex items-center justify-center w-40 h-[5vh] 
          hover:bg-white hover:text-black transition">
   Shop Men
</a>

<a href="{{ route('women.shoes') }}"
   class="bg-transparent border border-white text-white rounded-2xl shadow-lg 
          flex items-center justify-center w-40 h-[5vh] 
          hover:bg-white hover:text-black transition">
   Shop Women
</a>
    </div>
  </div>

</section>

<section class="max-w-full px-6 py-8 mx-auto grid
                grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3
                gap-6">
  <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4 justify-start">
    <p class="text-xl text-black">Wear All Day Comfort</p>
    <p class="text-gray-600 text-sm">Lightweight, bouncy, and wildly comfortable, Allbirds shoes make any outing feel effortless. Slip in, lace up, or slide them on and enjoy the comfy support.</p>
  </div>
  <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4 justify-start">
    <p class="text-xl text-black">Sustainability In Every Step</p>
    <p class="text-gray-600 text-sm">From materials to transport, we're working to reduce our carbon footprint to near zero. Holding ourselves accountable and striving for climate goals isn't a 30-year goal—it's now.</p>
  </div>
  <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4 justify-start">
    <p class="text-xl text-black">Materials From The Earth</p>
    <p class="text-gray-600 text-sm">We replace petroleum-based synthetics with natural alternatives wherever we can. Like using wool, tree fiber, and sugarcane. They're soft, breathable, and better for the planet—win, win, win.</p>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const btn   = document.getElementById("sortBtn");
  const menu  = document.getElementById("dropdownMenu");
  const arrow = document.getElementById("arrowIcon");

  btn.addEventListener("click", function (e) {
    e.stopPropagation();
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

</x-layouts>