<x-layouts>
 
<section class="relative w-full h-[50vh] md:h-[60vh] bg-cover bg-center rounded-2xl" style="background-image: url('/images/apparel-hero.jpeg');">
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto h-full flex flex-col justify-between md:px-8 text-white">
        
        <!-- Top Links -->
        <div class="flex gap-6 text-sm font-light font-serif tracking-wide mt-12">
            <a href="#" class="hover:underline">Home/</a>
            <a href="#" class="hover:underline">Men/</a>
            <a href="#" class="hover:underline">Men's Apparel</a>
        </div>

        <!-- Heading near bottom -->
        <p class="max-w-xl text-3xl md:text-2xl font-medium font-serif lg:mb-8 leading-tight mb-12 md:mb-16 sm:text-sm">
            Men's Apparel
        </p>

    </div>
</section>



<div class="w-full max-w-6xl mx-auto px-6 py-4 flex items-center justify-between bg-[#E6DDD0] rounded-[40px] mt-4">

  <!-- Left: Filter + Count -->
  <div class="flex items-center gap-4">

    <button class="flex items-center gap-2 text-black text-sm font-medium hover:opacity-70 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707v6.172a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6.172a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z" />
      </svg>
      FILTER
    </button>

    @php
      $totalApparelCount = \App\Models\Product::where('type', 'apparel')
                                              ->where('gender', 'men')
                                              ->count();
    @endphp
    <span class="text-gray-600 text-sm">({{ $totalApparelCount }} products)</span>

  </div>

  <!-- Right: Switch + Dropdown -->
  <div class="flex items-center gap-4">

    <!-- MEN / WOMEN Switch -->
    <div class="flex items-center bg-[#E5DFD6] border border-[#D4CDC3] rounded-full p-[4px]">

    <a href="{{ url('/men/apparel') }}"
       class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
       {{ request()->is('men/apparel') ? 'bg-black text-white' : 'text-black' }}">
       MEN
    </a>

    <a href="{{ url('/women/apparel') }}"
       class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
       {{ request()->is('women/apparel') ? 'bg-black text-white' : 'text-black' }}">
       WOMEN
    </a>

</div>


    <!-- Dropdown -->
   <div class="relative inline-block">

  <!-- Button -->
  <button id="sortBtn"
    class="flex items-center gap-2 px-6 py-2 bg-[#E5DFD6] border border-[#D4CDC3] rounded-full text-[13px] font-medium text-black hover:opacity-80 transition">
    FEATURED
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" id="arrowIcon"
      fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- Dropdown -->
  <div id="dropdownMenu"
  class="absolute right-0 mt-2 w-44 bg-black border border-blue-700 rounded-xl shadow-lg hidden z-30">

  <a href="?sort=featured"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition cursor-pointer">
   FEATURED
  </a>

  <a href="?sort=best"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
  BEST SELLING
  </a>

  <a href="?sort=az"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
  ALPHABETICALLY, A-Z
  </a>

  <a href="?sort=za"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
   ALPHABETICALLY, Z-A
  </a>

   <a href="?sort=price_low"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
 PRICE, LOW TO HIGH
  </a>

  <a href="?sort=price_high"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
 PRICE, HIGH TO LOW
  </a>

</div>
</div>


  </div>

</div>

<!-- JS for Men/Women toggle and Dropdown -->
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




<!-- APPAREL CARDS SECTION - DATABASE DRIVEN WITH SHOES ANIMATION -->
<section class="max-w-full px-4 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">

  @php
    $apparelProducts = \App\Models\Product::where('type', 'apparel')
                                          ->where('gender', 'men')
                                          ->orderBy('is_featured', 'desc')
                                          ->orderBy('created_at', 'desc')
                                          ->get();
  @endphp

  @forelse($apparelProducts as $product)
  <div class="relative group w-full block bg-white p-6 pt-10 h-[420px] rounded-2xl shadow-2xl overflow-hidden cursor-pointer
          transition-all duration-300 ease-out hover:h-[520px] hover:-translate-y-2">

    @if($product->is_new)
    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full z-10">
      NEW
    </span>
    @endif
    
    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover rounded-xl" alt="{{ $product->name }}" />

    <h1 class="mt-20 text-sm font-semibold text-black">
      {{ strtoupper($product->name) }}
    </h1>
    <p class="text-gray-500 text-sm">{{ $product->color_name ?? 'Various Colors' }}</p>
    <p class="text-black font-semibold">
      @if($product->on_sale)
        <span class="text-red-600">${{ number_format($product->sale_price, 0) }}</span>
        <span class="text-gray-400 line-through ml-2 text-xs">${{ number_format($product->price, 0) }}</span>
      @else
        ${{ number_format($product->price, 0) }}
      @endif
    </p>

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
  @empty
  <div class="col-span-full text-center py-12">
    <p class="text-gray-500 text-lg">No apparel products available at the moment.</p>
  </div>
  @endforelse

</section>


 
<section class="w-full px-2 sm:px-4 lg:px-6 py-6 grid
                grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3
                gap-2 sm:gap-4 md:gap-6 lg:gap-4">

  <!-- Card 1 - Shoes -->
  <div class="relative rounded-2xl overflow-hidden shadow-lg w-full mx-auto cursor-pointer group">

    <img src="{{ asset('images/first.webp') }}"
         class="w-full h-[400px] sm:h-[300px] md:h-[350px] lg:h-auto object-cover rounded-2xl
                transition-transform duration-1000 ease-out
                group-hover:scale-105" />

    <h1 class="absolute inset-0 flex items-center justify-center
               text-white text-4xl 
               bg-black/10 font-light font-serif
               pointer-events-none">
     Shoes
    </h1>

    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-4">
      <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                 flex items-center justify-center
                   w-40 sm:w-38 md:w-45 lg:w-45 h-[5vh]
                 hover:bg-white hover:text-black transition">
    Shop Men
  </button>

      <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                 flex items-center justify-center
                 w-40 sm:w-38 md:w-45 lg:w-45 h-[5vh]
                 hover:bg-white hover:text-black transition">
   Shop Women
  </button>
    </div>

  </div>

  <!-- Card 2 - Apparel -->
  <div class="relative rounded-2xl overflow-hidden shadow-lg w-full mx-auto cursor-pointer group">

    <img src="{{ asset('images/second.webp') }}" 
         class="w-full h-[400px] sm:h-[300px] md:h-[350px] lg:h-auto object-cover rounded-2xl
                transition-transform duration-1000 ease-out
                group-hover:scale-105" />

    <h1 class="absolute inset-0 flex items-center justify-center
               text-white text-4xl font-light font-serif
               bg-black/10
               pointer-events-none">
    Apparel
    </h1>

    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-4">
      <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                 flex items-center justify-center
                   w-40 sm:w-38 md:w-45 lg:w-45 h-[5vh]
                 hover:bg-white hover:text-black transition">
    Shop Men
  </button>

      <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                 flex items-center justify-center
                 w-40 sm:w-38 md:w-45 lg:w-45 h-[5vh]
                 hover:bg-white hover:text-black transition">
      Shop Women
  </button>
    </div>

  </div>

  <!-- Card 3 - Accessories -->
  <div class="relative rounded-2xl overflow-hidden shadow-lg w-full mx-auto cursor-pointer group">

    <img src="{{ asset('images/third.webp') }}" 
         class="w-full h-[400px] sm:h-[300px] md:h-[350px] lg:h-auto object-cover rounded-2xl
                transition-transform duration-1000 ease-out
                group-hover:scale-105" />

    <h1 class="absolute inset-0 flex items-center justify-center
               text-white text-4xl font-light font-serif
               bg-black/10
               pointer-events-none">
      Accessories
    </h1>

    
   <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-4">
      <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                 flex items-center justify-center
                   w-40 sm:w-38 md:w-45 lg:w-45 h-[5vh]
                 hover:bg-white hover:text-black transition">
    Shop Men
  </button>

      <button class="bg-transparent border border-white text-white rounded-2xl shadow-lg
                 flex items-center justify-center
                 w-40 sm:w-38 md:w-45 lg:w-45 h-[5vh]
                 hover:bg-white hover:text-black transition">
   Shop Women
  </button>
    </div>

  </div>

</section>

<section class="max-w-full px-6 py-8 mx-auto grid 
                grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 
                gap-6">

  <!-- Card 1 -->
  <div class="bg-white rounded-2xl shadow-xl p-6 
              w-full flex flex-col gap-4 justify-start">
    <p class="text-xl text-black">
      Wear All Day Comfort
    </p>
    <p class="text-gray-600 text-sm">
      Lightweight, bouncy, and wildly comfortable, Allbirds shoes make any outing feel effortless. Slip in, lace up, or slide them on and enjoy the comfy support.
    </p>
  </div>

  <!-- Card 2 -->
  <div class="bg-white rounded-2xl shadow-xl p-6 
              w-full flex flex-col gap-4 justify-start">
    <p class="text-xl text-black">
      Sustainability In Every Step
    </p>
    <p class="text-gray-600 text-sm">
      From materials to transport, we're working to reduce our carbon footprint to near zero. Holding ourselves accountable and striving for climate goals isn't a 30-year goal—it's now.
    </p>
  </div>

  <!-- Card 3 -->
  <div class="bg-white rounded-2xl shadow-xl p-6 
              w-full flex flex-col gap-4 justify-start">
    <p class="text-xl text-black">
      Materials From The Earth
    </p>
    <p class="text-gray-600 text-sm">
      We replace petroleum-based synthetics with natural alternatives wherever we can. Like using wool, tree fiber, and sugarcane. They're soft, breathable, and better for the planet—win, win, win.
    </p>
  </div>

</section>

</x-layouts>