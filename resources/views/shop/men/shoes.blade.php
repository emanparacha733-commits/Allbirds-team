<x-layouts>
 
<section class="relative w-full h-[50vh] md:h-[60vh] bg-cover bg-center rounded-2xl" style="background-image: url('/images/hero1.jpeg');">
    <!-- Overlay -->
   
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto h-full flex flex-col justify-between md:px-8 text-white">
        
        <!-- Top Links -->
        <div class="flex gap-6 text-sm font-light font-serif tracking-wide mt-12">
            <a href='/' class="hover:underline">Home/</a>
            <a href='/women/shoes' class="hover:underline">Women/</a>
            <a href='/women/shoes' class="hover:underline">Women's Dasher Nz Collection</a>
        </div>

        <!-- Heading near bottom -->
        <p class="max-w-xl text-3xl  md:text-2xl font-medium font-serif lg:mb-8 leading-tight mb-12 md:mb-16 sm:text-sm">
            Men's Dasher NZ Collection
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

    <span class="text-gray-600 text-sm">(18 products)</span>

  </div>

  <!-- Right: Switch + Dropdown -->
  <div class="flex items-center gap-4">

    <!-- MEN / WOMEN Switch -->
    <div class="flex items-center bg-[#E5DFD6] border border-[#D4CDC3] rounded-full p-[4px]">

    <a href="{{ url('/men/shoes') }}"
       class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
       {{ request()->is('men/shoes') ? 'bg-black text-white' : 'text-black' }}">
       MEN
    </a>

    <a href="{{ url('/women/shoes') }}"
       class="px-6 py-1.5 rounded-full text-[13px] font-medium transition
       {{ request()->is('women/shoes') ? 'bg-black text-white' : 'text-black' }}">
       WOMEN
    </a>

</div>


    <!-- Dropdown -->
   <div class="relative inline-block">

  <!-- Button -->
  <button id="sortBtn"
    class="flex items-center gap-2 px-6 py-2 bg-[#E5DFD6] border border-[#D4CDC3] rounded-full text-[13px] font-medium text-black hover:opacity-80 transition">
    BEST SELLING
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" id="arrowIcon"
      fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- Dropdown -->
  <div id="dropdownMenu"
  class="absolute right-0 mt-2 w-44 bg-black border border-blue-700 rounded-xl shadow-lg hidden z-50">

  <a href="?sort=best"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition cursor-pointer">
   FEATURED
  </a>

  <a href="?sort=price_low"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
  BEST SELLING
  </a>

  <a href="?sort=price_high"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
  ALPHABATICALLY,A-Z
  </a>

  <a href="?sort=new"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
   ALPHABATICALLY,Z-A
  </a>

   <a href="?sort=new"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
 PRICE,LOW TO HIGH
  </a>

  <a href="?sort=new"
    class="block px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
 PRICE,HIGHT TO LOW
  </a>

</div>
</div>


  </div>

</div>
</div>

<!-- JS for Men/Women toggle -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const menBtn = document.getElementById("menBtn");
    const womenBtn = document.getElementById("womenBtn");

    function setActive(activeBtn, inactiveBtn) {
        activeBtn.classList.add("bg-black", "text-white");
        activeBtn.classList.remove("text-gray-700");

        inactiveBtn.classList.remove("bg-black", "text-white");
        inactiveBtn.classList.add("text-gray-700");
    }

    menBtn.addEventListener("click", function (e) {
        setActive(menBtn, womenBtn);
    });

    womenBtn.addEventListener("click", function (e) {
        setActive(womenBtn, menBtn);
    });

});
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




<!-- section 2 -->
<x-product-grid>

    <x-product-card 
        image="/images/sho3.png"
        title="MEN'S DASHER NZ"
        subtitle="Comfortable Running Shoes"
        price="140"
    >
        <div class="grid grid-cols-5 gap-2">
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6.5</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">7</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6.5</div>
        </div>
    </x-product-card>

    <x-product-card 
        image="/images/yellow1.webp"
        title="MEN'S DASHER NZ"
        subtitle="Comfortable Running Shoes"
        price="140"
        link="/men/shop/men/detailshoes"
    >
        <div class="grid grid-cols-5 gap-2">
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center">8</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6.5</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
        </div>
    </x-product-card>

    <x-product-card 
        image="/images/sho6.png"
        title="MEN'S DASHER NZ"
        subtitle="Comfortable Running Shoes"
        price="140"
    >
        <div class="grid grid-cols-5 gap-2">
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6.5</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
        </div>
    </x-product-card>

    <x-product-card 
        image="/images/sho6.png"
        title="MEN'S DASHER NZ"
        subtitle="Comfortable Running Shoes"
        price="140"
    >
        <div class="grid grid-cols-5 gap-2">
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6.5</div>
            <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
        </div>
    </x-product-card>

</x-product-grid>




 
<section class="relative z-10 w-full px-2 sm:px-4 lg:px-6 py-6 grid
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