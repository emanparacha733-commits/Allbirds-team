<x-layouts>

{{-- Safe decode color_variants regardless of DB format --}}
@php
    $colorVariants = $product->color_variants;
    if (is_string($colorVariants)) {
        $colorVariants = json_decode($colorVariants, true) ?? [];
    }
    if (!is_array($colorVariants)) {
        $colorVariants = [];
    }
@endphp


<style>
  html, body {
    overflow-x: hidden !important;
    max-width: 100%;
  }
</style>

<div class="max-w-8xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-[55%_45%] gap-8 items-start">

  <!-- LEFT SIDE (Images) -->
  <div class="relative w-full flex flex-col gap-0 h-[150vh]">
    <div class="relative w-full flex flex-col gap-0">

      <span class="absolute top-0 left-0 bg-gray-200 text-xs mt-30 px-3 py-1 rounded-full z-10">
        {{ $product->is_new ? 'NEW' : ($product->on_sale ? 'SALE' : 'IN STOCK') }}
      </span>

      <!-- Main Large Image -->
      <img id="mainImage" src="{{ $product->image_url }}"
           class="w-full h-[650px] object-contain rounded-xl block bg-gray-50">

      <!-- Thumbnails -->
      <div class="grid grid-cols-3 gap-2 mt-2">

        {{-- Thumb 1: main image --}}
        <img 
         
        
        class="w-full h-[120px] object-contain rounded-lg cursor-pointer bg-gray-50 border-2 border-gray-300"
             src="{{ $product->image_url }}"
             onclick="setMain(this)">
             <!-- thumb2 -->

      @if($product->image_2)
          <img 
         
          class="
          w-full h-[120px] object-contain rounded-lg cursor-pointer  border-transparent  border-gray-300 hover:border-black bg-gray-50 transition"
               src="{{ asset('storage/' . $product->image_2) }}"
               onclick="setMain(this)">
        @else
          <div class="w-full h-[120px] rounded-lg bg-gray-100 flex items-center justify-center text-xs text-gray-400">No image</div>
        @endif

          {{-- Thumb 3 --}}
        @if($product->image_3)
          <img
          
          class="w-full h-[120px] object-contain rounded-lg cursor-pointer border-transparent bg-gray-50 transition"
               src="{{ asset('storage/' . $product->image_3) }}"
               onclick="setMain(this)">
        @else
          <div class="w-full h-[120px] rounded-lg bg-gray-100 flex items-center justify-center text-xs text-gray-400">No image</div>
        @endif
       
      </div>

      {{-- Color Variant Images --}}
  

    </div>
  </div>

  <!-- RIGHT SIDE PANEL -->
  <div class="flex flex-col gap-3 justify-start py-4 px-6 bg-white mt-20 rounded-2xl">

    <h1 class="text-3xl font-serif text-black mt-0">
      {{ $product->name }}
    </h1>

    <p class="text-sm text-gray-500">
      ALSO AVAILABLE IN:
      <span class="underline cursor-pointer">
        {{ $product->gender === 'men' ? "WOMEN'S SIZES" : "MEN'S SIZES" }}
      </span>
    </p>

    <!-- Price -->
    <div class="flex items-center gap-3">
      @if($product->on_sale && $product->sale_price)
        <p class="text-lg font-semibold text-red-600">${{ number_format($product->sale_price, 0) }}</p>
        <p class="text-base text-gray-400 line-through">${{ number_format($product->price, 0) }}</p>
        <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">SALE</span>
      @else
        <p class="text-lg font-semibold text-black">${{ number_format($product->price, 0) }}</p>
      @endif
    </div>

    <!-- Tabs (ALL / LIMITED / CLASSIC) -->
    <div class="flex gap-6 text-sm text-black mt-1">
      <span class="tab cursor-pointer underline font-medium" data-tab="all">ALL</span>
      <span class="tab cursor-pointer text-gray-500" data-tab="limited">LIMITED</span>
      <span class="tab cursor-pointer text-gray-500" data-tab="classic">CLASSIC</span>
    </div>

    <!-- Color Swatches -->
    <p class="text-sm mb-1" id="colorLabel">
      @if(!empty($colorVariants))
        {{ $colorVariants[0]['color_name'] ?? $product->color_name ?? '' }}
      @else
        {{ $product->color_name ?? '' }}
      @endif
    </p>
    <div class="flex items-center gap-3 flex-wrap">
      @if(!empty($colorVariants))
        @foreach($colorVariants as $variant)
        <div class="p-[3px] rounded-full border border-black cursor-pointer hover:scale-110 transition"
             onclick="selectColor('{{ $variant['color_name'] ?? '' }}', '{{ !empty($variant['image']) ? asset('storage/'.$variant['image']) : '' }}')"
             title="{{ $variant['color_name'] ?? '' }}">
          <div class="w-8 h-8 rounded-full border border-gray-300"
               style="background-color: {{ $variant['color_hex'] ?? '#000' }}"></div>
        </div>
        @endforeach
      @elseif($product->color_hex)
        <div class="p-[3px] rounded-full border border-black cursor-pointer">
          <div class="w-8 h-8 rounded-full border border-gray-300"
               style="background-color: {{ $product->color_hex }}"></div>
        </div>
      @endif
    </div>

    <!-- Sizes -->
    <div class="flex gap-6 text-sm mt-4">
      <span class="underline text-black">
        {{ strtoupper($product->gender === 'women' ? "Women's" : "Men's") }} SIZES
      </span>
    </div>

    <div id="sizeGrid" class="grid grid-cols-6 gap-3 mt-2 font-bold text-black">
      @forelse($product->available_sizes as $size)
        <button
          class="size-btn border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer rounded-md transition"
          data-tab="all classic">
          {{ $size }}
        </button>
      @empty
        <p class="col-span-6 text-sm text-gray-400 py-2">Sizes not available</p>
      @endforelse
    </div>

    <p class="text-sm text-gray-600 mt-2">
      Fits true-to-size for most customers.<br>
      <button id="openFitGuide" class="underline hover:text-black">Fit Guide</button>
    </p>

    <button id="selectSizeBtn"
            class="w-full bg-gray-200 text-gray-500 py-4 rounded-full font-medium text-sm mt-4 cursor-not-allowed"
            disabled>
      SELECT A SIZE
    </button>

    <p class="text-gray-700 text-center mt-6 text-sm">
      Free Shipping on Orders over $75 <br> Easy Returns
    </p>

  </div>
</div>

<!-- ===================== SCRIPTS ===================== -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  

  /* ── Image Gallery ── */
  window.setMain = function(thumb) {
    document.getElementById('mainImage').src = thumb.src;
    document.querySelectorAll('[onclick^="setMain"]').forEach(t => {
      t.classList.remove('border-black');
      t.classList.add('border-transparent');
    });
    thumb.classList.add('border-black');
    thumb.classList.remove('border-transparent');
  };

  window.setMainSrc = function(src) {
    document.getElementById('mainImage').src = src;
  };

  /* ── Color ── */
  window.selectColor = function(name, imgSrc) {
    document.getElementById('colorLabel').textContent = name;
    if (imgSrc) setMainSrc(imgSrc);
  };

  /* ── Tabs ── */
  const tabs        = document.querySelectorAll('.tab');
  const sizeButtons = document.querySelectorAll('.size-btn');

  function filterSizes(tab) {
    sizeButtons.forEach(btn => {
      const allowed = (btn.dataset.tab || 'all').split(' ');
      btn.style.display = allowed.includes(tab) ? 'block' : 'none';
    });
  }
  filterSizes('all');

  tabs.forEach(tabEl => {
    tabEl.addEventListener('click', () => {
      tabs.forEach(t => {
        t.classList.remove('underline', 'font-medium', 'text-black');
        t.classList.add('text-gray-500');
      });
      tabEl.classList.add('underline', 'font-medium', 'text-black');
      tabEl.classList.remove('text-gray-500');
      filterSizes(tabEl.dataset.tab);
    });
  });

  /* ── Size select & Add to Cart ── */
  const sizeGrid  = document.getElementById('sizeGrid');
  const selectBtn = document.getElementById('selectSizeBtn');
  let selectedSize = null;

  if (sizeGrid) {
    sizeGrid.addEventListener('click', function (e) {
      const btn = e.target.closest('button.size-btn');
      if (!btn || btn.disabled) return;

      sizeGrid.querySelectorAll('button.size-btn').forEach(b => {
        b.classList.remove('bg-black', 'text-white');
        b.classList.add('border-gray-300');
      });
      btn.classList.remove('border-gray-300');
      btn.classList.add('bg-black', 'text-white');

      selectedSize = btn.textContent.trim();
      selectBtn.disabled = false;
      selectBtn.classList.remove('bg-gray-200', 'text-gray-500', 'cursor-not-allowed');
      selectBtn.classList.add('bg-black', 'text-white', 'cursor-pointer');
      selectBtn.textContent = 'ADD TO CART';
    });
  }

  selectBtn.addEventListener('click', function () {
    if (!selectedSize) return;
    document.getElementById('formSize').value = selectedSize;
    document.getElementById('addToCartForm').submit();
  });

  /* ── Fit Guide Modal ── */
  const openBtn     = document.getElementById('openFitGuide');
  const closeBtn    = document.getElementById('closeFitGuide');
  const modal       = document.getElementById('fitModal');
  const modalContent= document.getElementById('modalContent');

  if (openBtn && modal) {
    function openModal() {
      modal.classList.remove('opacity-0', 'invisible');
      modal.classList.add('opacity-100', 'visible');
      modalContent.classList.remove('scale-95');
      modalContent.classList.add('scale-100');
    }
    function closeModal() {
      modal.classList.remove('opacity-100', 'visible');
      modal.classList.add('opacity-0', 'invisible');
      modalContent.classList.remove('scale-100');
      modalContent.classList.add('scale-95');
    }
    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
  }

  /* ── Swiper ── */
  if (typeof Swiper !== 'undefined') {
    new Swiper('.mySwiper', {
      slidesPerView: 4, spaceBetween: 30, loop: true, speed: 800, grabCursor: true,
      navigation: { nextEl: '.custom-next', prevEl: '.custom-prev' },
      breakpoints: { 0: { slidesPerView: 1 }, 640: { slidesPerView: 2 }, 1024: { slidesPerView: 4 } },
    });
  }

});
</script>


<!-- ── Product Details ── -->
<div class="w-full mx-auto lg:px-16 px-4 py-8 bg-white rounded-xl shadow-md grid mt-20 lg:grid-cols-3 gap-8 items-center">

  <div class="lg:col-span-1 flex flex-col gap-4">
    <h2 class="text-sm tracking-widest text-gray-600">WHY WE LOVE THIS</h2>
    <p class="text-gray-800 leading-relaxed">
      {{ $product->description ?? 'A new take on our fan-favorite Dasher, made for busy days and spontaneous plans. Lightweight, breathable comfort keeps you cool as you move, with added heel protection where it counts. Fast when you want. Comfortable always.' }}
    </p>

    <h3 class="text-xs tracking-widest text-gray-500 mt-2">BEST FOR</h3>
    <div class="flex flex-wrap gap-2 mt-1">
      <span class="px-3 py-1 text-xs bg-gray-200 rounded-full">Walking</span>
      <span class="px-3 py-1 text-xs bg-gray-200 rounded-full">Jogging</span>
      <span class="px-3 py-1 text-xs bg-gray-200 rounded-full">Commuting</span>
      <span class="px-3 py-1 text-xs bg-gray-200 rounded-full">Light Workouts</span>
      <span class="px-3 py-1 text-xs bg-gray-200 rounded-full">Everyday-ing</span>
    </div>

    <div x-data="{ open: false }" class="mt-2">
      <a href="#" @click.prevent="open = !open" class="text-sm text-gray-600 hover:underline inline-block">
        <span x-text="open ? 'Hide technical details' : '> View technical details'"></span>
      </a>
      <ul x-show="open" x-transition class="mt-2 text-gray-700 space-y-1 text-sm">
        <li><strong>Weight:</strong> 10.9oz (M9) 9.0oz (W7)</li>
        <li><strong>Heel/Toe Drop:</strong> 7mm</li>
        <li><strong>Stack Height:</strong> Heel: 22.9mm, Toe: 15.9mm</li>
        <li><strong>Country of Origin:</strong> Vietnam</li>
      </ul>
    </div>
  </div>

  <div class="lg:col-span-1 flex justify-center">
    <div class="w-64 h-64 rounded-full bg-gray-100 flex items-center justify-center">
      <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-52 h-52 object-contain rounded-full">
    </div>
  </div>

  <div class="lg:col-span-1 flex flex-col gap-2 text-gray-700">
    <h3 class="text-xs tracking-widest text-gray-500">THOUGHTFULLY DESIGNED</h3>
    <ul class="list-disc pl-4 space-y-1 text-sm">
      <li><span class="font-semibold">Breathable tree knit</span> upper for a light, cool feel</li>
      <li><span class="font-semibold">Easy-entry heel tab</span> for quick slip on and off</li>
      <li><span class="font-semibold">Wool-blend lining</span> for softness, socks optional</li>
      <li><span class="font-semibold">Sugarcane-based SweetFoam® cushioning</span> with responsive energy return</li>
      <li><span class="font-semibold">Plush Featherbed™ memory foam</span> insole for extra comfort</li>
      <li><span class="font-semibold">Redesigned traction</span> pattern for more grip on paved surfaces</li>
    </ul>
  </div>
</div>


<!-- ── FAQ Accordions ── -->
<div x-data="{ open: false }" class="w-full border border-gray-200 overflow-hidden mb-4 bg-white mt-8 shadow-md rounded-2xl">
  <button @click="open = !open"
          class="w-full flex justify-between items-center px-4 py-8 font-mono text-left text-gray-800 font-medium text-xl hover:bg-gray-50 transition">
    <span>Materials & Sustainability</span>
    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
    <svg x-show="open"  xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
  </button>
  <div x-show="open" x-transition class="px-4 py-4 text-gray-700 bg-gray-50 grid grid-cols-2 md:grid-cols-4 gap-4">
    <p><strong>Upper:</strong> Tree Knit – TENCEL® Lyocell and recycled polyester</p>
    <p><strong>Midsole:</strong> SweetFoam® – Sugarcane-based EVA foam</p>
    <p><strong>Outsole:</strong> Natural rubber – For durability and traction</p>
    <p><strong>Laces:</strong> 100% recycled polyester from plastic bottles</p>
  </div>
</div>

<div x-data="{ open: false }" class="w-full border border-gray-200 rounded-2xl overflow-hidden mb-4 bg-white shadow-md">
  <button @click="open = !open"
          class="w-full flex justify-between items-center px-4 py-6 text-left text-gray-800 font-medium hover:bg-gray-50 transition font-mono text-xl">
    <span>Care Instructions</span>
    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
    <svg x-show="open"  xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
  </button>
  <div x-show="open" x-transition class="px-4 py-4 text-gray-700 bg-gray-50">
    Yes, they're machine washable. Remove the insoles, hand wash those separately, and let everything air dry.
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<br>

<!-- ── Comfort Section ── -->
<h1 class="text-5xl text-center mt-6 font-light font-sans">Wildly Comfortable. Super Natural.</h1>

<section class="w-full px-2 sm:px-4 lg:px-6 py-6 grid mt-5
                grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3
                gap-2 sm:gap-4 md:gap-6 lg:gap-4">
  <div class="relative rounded-2xl overflow-hidden w-full mx-auto cursor-pointer group font-sans">
    <img src="{{ asset('images/detsho1.webp') }}"
         class="w-full object-cover rounded-2xl sm:h-48 lg:h-auto md:h-auto transition-transform duration-1000 ease-out group-hover:scale-105" />
    <div class="mt-6 text-center">
      <h4 class="text-lg font-semibold text-gray-800 mb-1">LOOK GOOD</h4>
      <p class="text-sm text-gray-600">Built to look sharp whether you're moving fast—or taking your time</p>
    </div>
  </div>
  <div class="relative rounded-2xl overflow-hidden w-full mx-auto cursor-pointer group font-sans">
    <img src="{{ asset('images/detsho2.webp') }}"
         class="w-full object-cover rounded-2xl sm:h-48 lg:h-auto md:h-auto transition-transform duration-1000 ease-out group-hover:scale-105" />
    <div class="mt-4 text-center">
      <h4 class="text-lg font-semibold text-gray-800 mb-1">FEEL GOOD</h4>
      <p class="text-sm text-gray-600">Wildly comfortable from the first step, with breathable support that moves naturally with you</p>
    </div>
  </div>
  <div class="relative rounded-2xl overflow-hidden w-full mx-auto cursor-pointer group font-sans">
    <img src="{{ asset('images/detsho3.webp') }}"
         class="w-full object-cover rounded-2xl sm:h-48 lg:h-auto md:h-auto transition-transform duration-1000 ease-out group-hover:scale-105" />
    <div class="mt-4 text-center">
      <h4 class="text-lg font-semibold text-gray-800 mb-1">DO GOOD</h4>
      <p class="text-sm text-gray-600">Made with TENCEL Lyocell (tree fiber) with breathable support that moves naturally with you</p>
    </div>
  </div>
</section>


<!-- ── Fit Guide Modal ── -->
<div id="fitModal" class="fixed inset-0 bg-black/50 flex items-center justify-center opacity-0 invisible transition-all duration-300 z-50">
  <div class="bg-white w-[95%] max-w-5xl rounded-2xl p-6 relative transform scale-95 transition-all duration-300" id="modalContent">
    <button id="closeFitGuide" class="absolute top-4 right-4 text-2xl font-light">&times;</button>
    <h2 class="text-2xl font-semibold text-center mb-2">{{ $product->name }}</h2>
    <div class="w-full flex justify-center mt-2 mb-4">
      <p class="bg-red-100 inline-block px-4 py-2 rounded-full text-sm">
        Fits true-to-size for most customers.
      </p>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-6">
      <img src="{{ $product->image_url }}" alt="Front View" class="rounded-xl max-h-60 w-full object-cover">
      <img src="{{ $product->image_url }}" alt="Side View"  class="rounded-xl max-h-60 w-full object-cover opacity-80">
    </div>
    <div class="overflow-x-auto rounded-2xl border border-gray-200">
      <table class="w-full text-center text-sm border-collapse">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-3 py-2 border border-gray-200 bg-red-100">US</th>
            @foreach(['8','8.5','9','9.5','10','10.5','11','11.5','12','12.5','13','13.5','14'] as $s)
            <th class="px-3 py-2 border border-gray-200">{{ $s }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          <tr class="bg-gray-50">
            <td class="px-3 py-2 border border-gray-200 bg-red-100">UK</td>
            @foreach(['7','7.5','8','8.5','9','9.5','10','10.5','11','11.5','12','12.5','13'] as $s)
            <td class="px-3 py-2 border border-gray-200">{{ $s }}</td>
            @endforeach
          </tr>
          <tr>
            <td class="px-3 py-2 border border-gray-200 bg-red-100">cm</td>
            @foreach(['26','26.5','27','27.5','28','28.5','29','29.5','30','30.5','31','31.5','32'] as $s)
            <td class="px-3 py-2 border border-gray-200">{{ $s }}</td>
            @endforeach
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- ── Collection Banner ── -->
<section class="w-full text-center rounded-2xl py-12 px-4 sm:px-6 lg:px-8 mt-8"
         style="background-color:#7C8C52">
  <p class="text-white text-sm font-medium mb-2 uppercase tracking-widest">
    The {{ $product->name }} Collection
  </p>
  <h1 class="text-white text-4xl sm:text-3xl md:text-5xl mt-5 font-serif">
    Comfort That Keeps Up
  </h1>
  <a href="{{ url('/men/shoes') }}"
     class="inline-block bg-transparent text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-gray-100 hover:text-black transition mt-8 border border-white">
    Shop Now
  </a>
</section>


<!-- ── You May Also Like Swiper ── -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<section class="w-full py-16">
  <div class="flex justify-between items-center mb-8 px-10">
    <h2 class="tracking-widest text-sm text-gray-700">YOU MAY ALSO LIKE</h2>
    <div class="flex gap-3">
      <div class="custom-prev w-10 h-10 rounded-full border border-black flex items-center justify-center cursor-pointer hover:bg-black hover:text-white transition">❮</div>
      <div class="custom-next w-10 h-10 rounded-full bg-black text-white flex items-center justify-center cursor-pointer hover:bg-gray-800 transition">❯</div>
    </div>
  </div>

  <div class="swiper mySwiper px-10 relative z-30 isolate overflow-visible max-w-full py-6 px-4">
    <div class="swiper-wrapper shadow-4xl px-6">

      @forelse($relatedProducts as $related)
      <div class="swiper-slide relative overflow-visible shadow-4xl">
        <a href="{{ route('products.show', $related->id) }}"
           class="group block bg-white p-6 pt-10 h-[450px] rounded-2xl shadow-xl relative z-30 transition-all duration-500 hover:z-50 hover:-translate-y-2">
          @if($related->is_new)
          <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">NEW</span>
          @endif
          <img src="{{ $related->image_url }}" class="w-full h-48 object-cover rounded-xl"/>
          <h4 class="mt-4 text-sm font-semibold text-black uppercase">{{ $related->name }}</h4>
          <p class="text-gray-500 text-sm">{{ $related->description ?? 'Men\'s Shoes' }}</p>
          <p class="text-black font-semibold">${{ number_format($related->price, 0) }}</p>
          <!-- Hover size panel -->
          <div class="absolute left-0 bottom-0 w-full p-4 bg-white rounded-b-2xl opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-50 shadow-xl">
            <div class="grid grid-cols-5 gap-2">
              @foreach(array_slice($related->available_sizes ?? [], 0, 10) as $size)
              <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100 text-sm">{{ $size }}</div>
              @endforeach
            </div>
          </div>
        </a>
      </div>
      @empty
      @foreach(range(1,4) as $i)
      <div class="swiper-slide shadow-2xl z-30">
        <a href="{{ url('/men/shoes') }}" class="relative group block bg-white p-6 pt-10 h-[420px] rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:-translate-y-2">
          <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">NEW</span>
          <img src="/images/sho2.png" class="w-full h-48 object-cover rounded-xl"/>
          <h4 class="mt-8 text-sm font-semibold text-black">MEN'S VARSITY</h4>
          <p class="text-gray-500 text-sm">Classic Everyday Sneaker</p>
          <p class="text-black font-semibold">$120</p>
        </a>
      </div>
      @endforeach
      @endforelse

    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<!-- ── Nature Section ── -->
<section class="relative w-full h-[60vh] md:h-[80vh] bg-cover bg-center rounded-2xl overflow-hidden mt-8"
         style="background-image: url('/images/animalbg.webp');">
  <div class="relative w-full h-full flex flex-col justify-center items-center text-center px-4 text-white">
    <div id="circlesWrapper" class="absolute w-[90%] max-w-[600px] aspect-[550/420] md:w-[600px] md:h-[420px] flex justify-center items-center">
      <div class="absolute border border-white rounded-full w-full h-full"></div>
      <div class="absolute border border-white rounded-full w-[94%] h-[90%]"></div>
      <div class="absolute border border-white bg-white/10 rounded-full w-[87%] h-[80%]"></div>
      <div id="ballsContainer" class="absolute w-full h-full top-0 left-0 z-20"></div>
      <span class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 border border-white text-white text-xs px-2 py-1 rounded-full">RENEWABLE MATERIALS</span>
      <span class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 border border-white text-white text-xs px-2 py-1 rounded-full">RESPONSIBLE ENERGY</span>
      <span class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 border border-white text-white text-xs px-2 py-1 rounded-full">REGENERATIVE AGRICULTURE</span>
    </div>
    <h4 class="text-lg md:text-xl mb-2 font-semibold">Better Things in a Better Way</h4>
    <p class="text-xs md:text-sm mb-4 font-serif">Looking to the world's greatest innovator - Nature</p>
    <a href="#" class="bg-white text-black px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-gray-200 transition">Learn More</a>
  </div>
</section>

<script>
function placeBalls() {
  const container = document.getElementById('ballsContainer');
  const wrapper   = document.getElementById('circlesWrapper');
  if (!container || !wrapper) return;
  container.innerHTML = '';
  const rect   = wrapper.getBoundingClientRect();
  const cx     = rect.width / 2;
  const cy     = rect.height / 2;
  const scaleX = rect.width / 550;
  const scaleY = rect.height / 420;
  for (let i = 0; i < 3; i++) {
    const angle = Math.random() * 2 * Math.PI;
    const x = cx + 275 * Math.cos(angle) * scaleX - 5;
    const y = cy + 210 * Math.sin(angle) * scaleY - 5;
    const ball = document.createElement('div');
    ball.className = 'w-3 h-3 bg-white rounded-full absolute';
    ball.style.left = `${x}px`;
    ball.style.top  = `${y}px`;
    container.appendChild(ball);
  }
}
window.addEventListener('load', placeBalls);
window.addEventListener('resize', placeBalls);
</script>


<!-- ── Bottom Feature Cards ── -->
<section class="max-w-full px-6 py-8 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
  <div class="bg-white rounded-2xl shadow-xl p-6 w-full flex flex-col gap-4">
    <p class="text-xl text-black">Wear All Day Comfort</p>
    <p class="text-gray-600 text-sm">Lightweight, bouncy, and wildly comfortable, Allbirds shoes make any outing feel effortless.</p>
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


<!-- ── Hidden Add to Cart Form ── -->
<form id="addToCartForm" action="{{ route('cart.add') }}" method="POST" style="display:none;">
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}">
  <input type="hidden" name="name"       value="{{ $product->name }}">
  <input type="hidden" name="price"      value="{{ $product->on_sale && $product->sale_price ? $product->sale_price : $product->price }}">
  <input type="hidden" name="image"      value="{{ $product->image_url }}">
  <input type="hidden" name="size"       id="formSize" value="">
</form>

</x-layouts>