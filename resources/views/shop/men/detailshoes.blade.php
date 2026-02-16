<x-layouts>
<div class="max-w-8xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-[55%_45%] gap-8 items-start">

  <!-- LEFT SIDE (Images) -->
<!-- LEFT SECTION ONLY -->

<div class="relative w-full flex flex-col gap-0 h-[150vh]">

  <!-- Main Image Container -->
  <div class="relative w-full flex flex-col gap-0">

    <!-- Badge (absolute on top-left of image) -->
    <span class="absolute top-0 left-0 bg-gray-200 text-xs mt-30 px-3 py-1 rounded-full z-10">
      NEW
    </span>

    <!-- Main Large Image -->
     <img id="mainImage" src="/images/yellow1.webp"
         class="w-full h-[650px] object-cover rounded-xl block">

    <!-- First Row of Bottom Thumbnails -->
  <div id="thumbRow1" class="grid grid-cols-2 gap-1 -mt-1">
        <img class="thumbnail w-full h-[150px] object-cover rounded-lg" src="/images/yellow2.webp">
        <img class="thumbnail w-full h-[150px] object-cover rounded-lg" src="/images/yellow3.webp">
      </div>

  <br><br>

    <!-- Second Row of Bottom Thumbnails -->
    <div id="thumbRow2" class="grid grid-cols-2 gap-1 -mt-1">
        <img class="thumbnail w-full h-[150px] object-cover rounded-lg" src="/images/yellow5.webp">
        <img class="thumbnail w-full h-[150px] object-cover rounded-lg" src="/images/yellow6.webp">
      </div>

  </div>
</div>





  <!-- RIGHT SIDE PANEL (Details) -->
 <div class="flex flex-col gap-3 justify-start py-4 px-6 bg-white rounded-x mt-20 rounded-2xl">

  <!-- Title -->
  <h1 class="text-3xl font-serif text-black mt-0">
    Men's Dasher NZ
  </h1>

  <p class="text-sm text-gray-500">
    ALSO AVAILABLE IN: <span class="underline cursor-pointer">WOMEN'S SIZES</span>
  </p>

  <p class="text-lg font-semibold text-black">$140</p>

  <!-- Tabs -->
 <div class="flex gap-6 text-sm text-black">
  <span class="tab cursor-pointer underline" data-tab="all">ALL</span>
  <span class="tab cursor-pointer text-gray-500" data-tab="limited">LIMITED</span>
  <span class="tab cursor-pointer text-gray-500" data-tab="classic">CLASSIC</span>
</div>


  <!-- Color Name -->
  <p class="text-sm mb-2">Ochre</p>

  <!-- Color Circles -->
<!-- Color Circles -->
<div class="flex items-center gap-3">
      <div class="color-circle p-[3px] rounded-full border border-black cursor-pointer" 
           data-images='[
            "/images/yellow1.webp",
            "/images/yellow2.webp",
            "/images/yellow3.webp",
            "/images/yellow5.webp",
            "/images/yellow6.webp"
           ]'   data-tab="all limited">
        <div class="w-8 h-8 rounded-full bg-[#B59A3A] border border-gray-300"></div>
      </div>

      <div class="color-circle w-8 h-8 rounded-full bg-[#E8E3D9] border border-gray-300 cursor-pointer"
           data-images='[
            "/images/whitemain.webp",
            "/images/white2.webp",
            "/images/white3.webp",
            "/images/white4.webp",
            "/images/white5.webp"
           ]'   data-tab="all classic"></div>

      <div class="color-circle w-8 h-8 rounded-full bg-[#A8A29E] border border-gray-300 cursor-pointer"
           data-images='[
            "/images/gray1.webp",
            "/images/gray2.webp",
            "/images/gray3.webp",
            "/images/gray4.webp",
            "/images/gray5.webp"
           ]'  data-tab="all limited"></div>

      <div class="color-circle w-8 h-8 rounded-full bg-[#4B4B4B] border border-gray-300 cursor-pointer"
           data-images='[
            "/images/black1.webp",
            "/images/black2.webp",
            "/images/black3.webp",
            "/images/black4.webp",
            "/images/black5.webp"
           ]'  data-tab="all limited"></div>

      <div class="color-circle w-8 h-8 rounded-full bg-[#6B705C] border border-gray-300 cursor-pointer"
           data-images='[
            "/images/green1.png",
            "/images/green2.webp",
            "/images/green3.webp",
            "/images/green4.webp",
            "/images/green5.webp"
           ]'  data-tab="all classic"></div>

      <div class="color-circle w-8 h-8 rounded-full bg-[#A45A52] border border-gray-300 cursor-pointer"
           data-images='[
            "/images/red1.webp",
            "/images/red2.webp",
            "/images/red3.webp",
            "/images/red4.webp",
            "/images/red5.webp"
           ]'  data-tab="all limited"></div>

      <div class="color-circle w-8 h-8 rounded-full border border-gray-300 cursor-pointer"
           style="background: linear-gradient(to right,#1F2937 50%,#D1D5DB 50%)"
           data-images='[
            "/images/gradiant1.webp",
            "/images/gradient2.webp",
            "/images/gradient3.webp",
            "/images/gradient4.webp",
            "/images/gradient5.webp"
           ]' data-tab="all classic"></div>

      <div class="color-circle w-8 h-8 rounded-full bg-[#D6D3D1] border border-gray-300 cursor-pointer"
           data-images='[
            "/images/lightgray1.webp",
            "/images/lightgray2.webp",
            "/images/lightgray3.webp",
            "/images/lightgray4.webp",
            "/images/lightgray5.webp"
           ]' data-tab="all classic"></div>

     

    </div>





  <!-- Sizes -->
  <div class="flex gap-6 text-sm mt-4">F
    <span class="underline text-black">MEN'S SIZES</span>
    <span class="text-gray-500">WOMEN'S SIZES</span>
  </div>

  <div class="grid grid-cols-6 gap-3 mt-2 font-bold text-black">
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer" data-tab="all classic">8</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer"  data-tab="all classic">8.5</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer"  data-tab="all classic">9</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer" data-tab="all classic">9.5</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer"  data-tab="all limited">10</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer"  data-tab="all classic">10.5</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer"  data-tab="all limited">11</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer"  data-tab="all classic">11.5</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer"  data-tab="all limited">12</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer" data-tab="all classic">12.5</button>
    <button class="border border-gray-300 py-2 text-sm hover:bg-gray-200 cursor-pointer"  data-tab="all limited">13</button>
    <button class="border border-gray-300 py-2 text-sm text-gray-400 line-through"  data-tab="all classic">14</button>
  </div>

  <p class="text-sm text-gray-600 mt-2">
    The Dasher NZ fits true-to-size for most customers.<br>
    <u>Fit Guide</u>
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



<script>
  const colorCircles = document.querySelectorAll('.color-circle');
   const tabs = document.querySelectorAll('.tab');
  const mainImage = document.getElementById('mainImage');
  const thumbRow1 = document.querySelectorAll('#thumbRow1 img');
  const thumbRow2 = document.querySelectorAll('#thumbRow2 img');
  const allThumbs = [...thumbRow1, ...thumbRow2];

  colorCircles.forEach(circle => {
  circle.addEventListener('click', () => {

    //  Remove active border from all
    colorCircles.forEach(c => {
      c.classList.remove('border-black','border-2');
      c.classList.add('border-gray-300');
    });

    
    circle.classList.remove('border-gray-300');
    circle.classList.add('border-black','border-2');

    // Update images
    const images = JSON.parse(circle.dataset.images);

    if(mainImage){
      mainImage.src = images[0];
    }

    allThumbs.forEach((thumb, index) => {
      if(images[index + 1]) {
        thumb.src = images[index + 1];
      }
    });



  });
});



 
 document.addEventListener("DOMContentLoaded", function() {

  const tabs = document.querySelectorAll('.tab');
  const sizeButtons = document.querySelectorAll('.grid button');

  function filterSizes(tab) {

    sizeButtons.forEach(btn => {

      if (!btn.dataset.tab) return;

      const tabsForSize = btn.dataset.tab.split(' ');

      if (tabsForSize.includes(tab)) {
        btn.style.display = "block";
      } else {
        btn.style.display = "none";
      }

    });

  }

  // Page load par ALL show
  filterSizes('all');

  // Tab click
  tabs.forEach(tabEl => {
    tabEl.addEventListener('click', () => {

      const selectedTab = tabEl.dataset.tab;

      // Tab styling update
      tabs.forEach(t => {
        t.classList.remove('underline','text-black');
        t.classList.add('text-gray-500');
      });

      tabEl.classList.add('underline','text-black');
      tabEl.classList.remove('text-gray-500');

      // Filter sizes
      filterSizes(selectedTab);

    });
  });

});
document.addEventListener("DOMContentLoaded", function() {

  const grid = document.querySelector('.grid');
  const selectBtn = document.getElementById('selectSizeBtn');
  const heading = document.getElementById('actionHeading');

  grid.addEventListener('click', function(e) {
    const btn = e.target.closest('button'); // nearest button clicked

    if(!btn || !grid.contains(btn)) return; // ignore clicks outside buttons

    // Remove active style from all visible buttons
    grid.querySelectorAll('button').forEach(b => {
      b.classList.remove('bg-black','text-white');
      b.classList.add('bg-gray-200','text-gray-500');
    });

    // Add active style to clicked button
    btn.classList.remove('bg-gray-200','text-gray-500');
    btn.classList.add('bg-black','text-white');

    // Enable SELECT button + change heading
    if(selectBtn && heading){
      selectBtn.disabled = false;
      selectBtn.classList.remove('bg-gray-200','text-gray-500','cursor-not-allowed');
      selectBtn.classList.add('bg-black','text-white','cursor-pointer');

      heading.textContent = "Add to Cart";
    }
  });

});

document.addEventListener("DOMContentLoaded", function() {

  const grid = document.querySelector('.grid'); // parent container of size buttons
  const selectBtn = document.getElementById('selectSizeBtn');

  grid.addEventListener('click', function(e) {
    const btn = e.target.closest('button'); // nearest button clicked

    if(!btn || !grid.contains(btn)) return; // ignore clicks outside buttons

    // Remove active style from all visible buttons
    grid.querySelectorAll('button').forEach(b => {
      b.classList.remove('bg-black','text-white');
      b.classList.add('bg-gray-200','text-gray-500');
    });

    // Add active style to clicked button
    btn.classList.remove('bg-gray-200','text-gray-500');
    btn.classList.add('bg-black','text-white');

    // Enable SELECT button + change its text
    if(selectBtn){
      selectBtn.disabled = false;
      selectBtn.classList.remove('bg-gray-200','text-gray-500','cursor-not-allowed');
      selectBtn.classList.add('bg-black','text-white','cursor-pointer');

      // Change button text
      selectBtn.textContent = "Add to Cart";
    }
  });

});
// slider js


 const swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 30,
    loop: true,
    speed: 800,
    grabCursor: true,

    navigation: {
      nextEl: ".custom-next",
      prevEl: ".custom-prev",
    },

    breakpoints: {
      0: { slidesPerView: 1 },
      640: { slidesPerView: 2 },
      1024: { slidesPerView: 4 }
    }
  });


  
  // Responsive balls positions
  const circles = [
    {rx: 275, ry: 210, balls: 3},
    {rx: 259, ry: 189, balls: 3},
    {rx: 240, ry: 168, balls: 3},
  ];

  
</script>

  
  




<div class="w-full mx-auto lg:px-16 px-4 py-8 bg-white rounded-xl shadow-md grid mt-20 lg:grid-cols-3 gap-8 items-center">

  <!-- Left Column: Description -->
  <div class="lg:col-span-1 flex flex-col gap-4">
    <h2 class="text-sm tracking-widest text-gray-600">WHY WE LOVE THIS</h2>
    <p class="text-gray-800 leading-relaxed">
      A new take on our fan-favorite Dasher, made for busy days and spontaneous plans.
      Lightweight, breathable comfort keeps you cool as you move, with added heel protection
      where it counts. Fast when you want. Comfortable always.
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

  <!-- Toggle button -->
  <a href="#" @click.prevent="open = !open" 
     class="text-sm text-gray-600 hover:underline inline-block">
    <span x-text="open ? 'Hide technical details' : '> View technical details'"></span>
  </a>

  <!-- Dropdown content -->
  <ul x-show="open" x-transition class="mt-2 text-gray-700 space-y-1">
    <li><strong>Weight:</strong> 10.9oz (M9) 9.0oz (W7)</li>
    <li><strong>Heel/Toe Drop:</strong> 7mm</li>
    <li><strong>Stack Height:</strong> Heel: 22.9mm, Toe: 15.9mm</li>
    <li><strong>Country of Origin:</strong> Vietnam</li>
  </ul>

</div>

  </div>

  <!-- Middle Column: Shoe Image -->
  <div class="lg:col-span-1 flex justify-center">
    <div class="w-64 h-64 rounded-full bg-gray-100 flex items-center justify-center relative">
      <img src="/images/yellow1.webp" alt="Shoe" class="w-52 h-52 object-contain rounded-full">
    </div>
  </div>

  <!-- Right Column: Features -->
  <div class="lg:col-span-1 flex flex-col gap-2 text-gray-700">
    <h3 class="text-xs tracking-widest text-gray-500">THOUGHTFULLY DESIGNED</h3>
    <ul class="list-disc pl-4 space-y-1 text-sm">
      <li><span class="font-semibold">Breathable tree knit</span> upper for a light, cool feel</li>
      <li><span class="font-semibold">Easy-entry heel tab</span> for quick slip on and off</li>
      <li><span class="font-semibold">Wool-blend lining</span> for softness, socks optional</li>
      <li><span class="font-semibold">Sugarcane-based SweetFoam® cushioning</span> with responsive energy return</li>
      <li><span class="font-semibold">Plush Featherbed™ memory foam</span> insole for extra comfort and bounce</li>
      <li><span class="font-semibold">Redesigned traction</span> pattern for more grip on paved surfaces</li>
    </ul>
  </div>

</div>



<!-- FAQ Question 1 -->
<div x-data="{ open: false }" class="w-full border border-gray-200 overflow-hidden mb-4 bg-white mt-8 shadow-md rounded-2xl">
  <button @click="open = !open"
          class="w-full flex justify-between items-center px-4 py-8 font-mono text-left text-gray-800 font-medium text-xl hover:bg-gray-50 transition">
    <span>Materials & Sustainability</span>
    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
    </svg>
  </button>

  

  <!-- Answers in 3 columns -->
  <div x-show="open" x-transition class="px-4 py-4 text-gray-700 bg-gray-50 grid grid-cols-4 gap-4">
    <p><strong>Upper:</strong> Tree Knit – Made from Eucalyptus tree-derived TENCEL® Lyocell and recycled polyester</p>
    <p><strong>Midsole:</strong> SweetFoam® – Sugarcane-based EVA foam provides comfort and durability while being light on the planet</p>
    <p><strong>Outsole:</strong> Natural rubber – For added durability and traction</p>
    <p><strong>Laces:</strong> 100% recycled polyester – Sourced from plastic bottles</p>
  </div>
</div>


<!-- FAQ Question 2 -->
<div x-data="{ open: false }" class="w-full border border-gray-200 rounded-2xl overflow-hidden mb-4 bg-white shadow-md">
  <button @click="open = !open"
          class="w-full flex justify-between items-center px-4 py-6  text-left text-gray-800 font-medium hover:bg-gray-50 transition font-mono text-xl">
    <span>Care Instructions</span>
    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
    </svg>
  </button>
  <div x-show="open" x-transition class="px-4 py-4 text-gray-700 bg-gray-50">
    Yes, they’re machine washable. Remove the insoles, hand wash those separately, and let everything air dry.
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<br>

<!-- image section -->

<h1 class="text-5xl text-center mt-6 font-light font-sans">Wildly Comfortable. Super Natural.</h1>

<section class="w-full px-2 sm:px-4 lg:px-6 py-6 grid mt-5
                grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3
                gap-2 sm:gap-4 md:gap-6 lg:gap-4">

  <!-- Card 1 -->
  <div class="relative rounded-2xl overflow-hidden  w-full mx-auto cursor-pointer group font-sans">

    <img src="{{ asset('images/detsho1.webp') }}" alt="Shoe 1"
         class="w-full object-cover rounded-2xl
                sm:h-48
                lg:h-auto
                md:h-auto
                transition-transform duration-1000 ease-out
                group-hover:scale-105" />

    <!-- Text Below Image -->
    <div class="mt-6 text-center">
      <h1 class="text-lg font-semibold text-gray-800 mb-1">LOOK GOOD</h1>
      <p class="text-sm text-gray-600">Build to look sharp whether you're moving <br>
    fast-or taking your time </p>
    </div>

  </div>

  <!-- Card 2 -->
  <div class="relative rounded-2xl overflow-hidden w-full mx-auto cursor-pointer group font-sans">

    <img src="{{ asset('images/detsho2.webp') }}" alt="Shoe 2"
         class="w-full object-cover rounded-2xl
                sm:h-48
                lg:h-auto
                md:h-auto
                transition-transform duration-1000 ease-out
                group-hover:scale-105" />

    <!-- Text Below Image -->
    <div class="mt-4 text-center">
      <h1 class="text-lg font-semibold text-gray-800 mb-1">FEEL GOOD</h1>
      <p class="text-sm text-gray-600">Widly comfortable from the first step,<br>
    with breathable support  that moves naturally with you</p>
    </div>

  </div>

  <!-- Card 3 -->
  <div class="relative rounded-2xl overflow-hidden  w-full mx-auto cursor-pointer group font-sans">

    <img src="{{ asset('images/detsho3.webp') }}" alt="Shoe 3"
         class="w-full object-cover rounded-2xl
                sm:h-48
                lg:h-auto
                md:h-auto
                transition-transform duration-1000 ease-out
                group-hover:scale-105" />

    <!-- Text Below Image -->
    <div class="mt-4 text-center">
      <h1 class="text-lg font-semibold text-gray-800 mb-1">DO GOOD</h1>
      <p class="text-sm text-gray-600">Made with TENCEL Lycoll(tree fiber)
        with breathable support  that moves naturally with you
      </p>
    </div>

  </div>

</section>

<section class="w-full text-center rounded-2xl py-12 px-4 sm:px-6 lg:px-8"
style="background-color:#7C8C52">
  <p class="text-white text-sm sm:text-base font-medium mb-2 uppercase tracking-widest">
    The Dasher NZ Collection
  </p>
  <h1 class="text-white text-4xl sm:text-3xl md:text-5xl mt-5 font-serif">
    Comfort That Keeps Up
  </h1>

  <a href="/shop" 
     class="inline-block bg-transparent text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-gray-100 transition-colors duration-300 mt-8 border border-white hover:text-black">
    Shop Now
  </a>
</section>

<!-- slider starts here -->
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<section class="w-full  py-16">

  <!-- Header + Arrows -->
  <div class="flex justify-between items-center mb-8 px-10">
    <h2 class="tracking-widest text-sm text-gray-700">
      YOU MAY ALSO LIKE
    </h2>

    <div class="flex gap-3">
      <div class="custom-prev w-10 h-10 rounded-full border border-black flex items-center justify-center cursor-pointer hover:bg-black hover:text-white transition">
        ❮
      </div>
      <div class="custom-next w-10 h-10 rounded-full bg-black text-white flex items-center justify-center cursor-pointer hover:bg-gray-800 transition">
        ❯
      </div>
    </div>
  </div>

  <!-- Swiper -->
  <div class="swiper mySwiper px-10 relative z-30 isolate overflow-visible max-w-full  py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 auto-rows-[420px]">
    <div class="swiper-wrapper">

      <!-- Slide 1 -->
   <!-- Swiper Slide -->
<div class="swiper-slide relative overflow-visible">
  <a href="#"
     class="group block bg-white p-6 pt-10 h-[420px] rounded-2xl shadow-xl relative z-30 transition-all duration-500 hover:z-50 hover:-translate-y-2">

    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">
      NEW
    </span>

    <img src="/images/sho7.png"
         class="w-full h-48 object-cover rounded-xl"/>

    <h4 class="mt-20 text-sm lg:font-semibold text-black">
      MEN'S VARSITY
    </h4>

    <p class="text-gray-500 text-sm">
      Classic Everyday Sneaker
    </p>

    <p class="text-black font-semibold">
      $120
    </p>

    <!-- Sizes Box -->
    <div class="absolute left-0 bottom-0 w-full p-4 bg-white rounded-b-2xl opacity-0 translate-y-4
                group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-50 shadow-xl">
      <div class="grid grid-cols-5 gap-2">
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">6</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">7</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">8</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">9</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">10</div>

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">10.5</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11.5</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">12</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">12.5</div>
      </div>
    </div>

  </a>
</div>


      <!-- Slide 2 -->
 <div class="swiper-slide shadow-2xl z-50">
  <a href="#"
     class="relative group block bg-white p-6 pt-10 h-[420px] 
            rounded-2xl shadow-xl overflow-visible
            transition-all duration-500 
            hover:h-[560px] hover:-translate-y-2">

    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">
      NEW
    </span>

    <img src="/images/sho2.png"
         class="w-full h-48 object-cover rounded-xl"/>

    <h4 class="mt-20 text-sm lg:font-semibold text-black">
      MEN'S VARSITY
</h4>

    <p class="text-gray-500 text-sm">
      Classic Everyday Sneaker
    </p>

    <p class="text-black font-semibold">
      $120
    </p>

    <!-- Sizes (Normal Flow) -->
    <div class="mt-4 opacity-0 translate-y-4
                group-hover:opacity-100 
                group-hover:translate-y-0
                transition-all duration-300">

      <div class="grid grid-cols-5 gap-2 mt-3">

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">6</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">7</div>

        <div class="relative h-10 border border-gray-300 rounded-md flex items-center justify-center text-gray-400">
          8
          <span class="absolute w-4/5 h-[1px] bg-gray-300 rotate-[-15deg]"></span>
        </div>

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">9</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">10</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11.5</div>

      </div>
    </div>

  </a>
</div>


      <!-- Slide 3 -->
   <div class="swiper-slide shadow-2xl z-30">
  <a href="#"
     class="relative group block bg-white p-6 pt-10 h-[420px] 
            rounded-2xl shadow-xl overflow-hidden
            transition-all duration-500 
            hover:h-[560px] hover:-translate-y-2">

    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">
      NEW
    </span>

    <img src="/images/sho2.png"
         class="w-full h-48 object-cover rounded-xl"/>

    <h4 class="mt-20 text-sm lg:font-semibold text-black">
      MEN'S VARSITY
</h4>


    <p class="text-gray-500 text-sm">
      Classic Everyday Sneaker
    </p>

    <p class="text-black font-semibold">
      $120
    </p>

    <!-- Sizes (Normal Flow) -->
    <div class="mt-4 opacity-0 translate-y-4
                group-hover:opacity-100 
                group-hover:translate-y-0
                transition-all duration-300">

      <div class="grid grid-cols-5 gap-2 mt-3">

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">6</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">7</div>

        <div class="relative h-10 border border-gray-300 rounded-md flex items-center justify-center text-gray-400">
          8
          <span class="absolute w-4/5 h-[1px] bg-gray-300 rotate-[-15deg]"></span>
        </div>

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">9</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">10</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11.5</div>

      </div>
    </div>

  </a>
</div>


      <!-- Slide 4 -->
    <div class="swiper-slide shadow-2xl z-30">
  <a href="#"
     class="relative group block bg-white p-6 pt-10 h-[420px] 
            rounded-2xl shadow-xl overflow-hidden
            transition-all duration-500 
            hover:h-[560px] hover:-translate-y-2">

    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">
      NEW
    </span>

    <img src="/images/sho2.png"
         class="w-full h-48 object-cover rounded-xl"/>

   <h4 class="mt-20 text-sm lg:font-semibold text-black">
      MEN'S VARSITY
</h4>

    <p class="text-gray-500 text-sm">
      Classic Everyday Sneaker
    </p>

    <p class="text-black font-semibold">
      $120
    </p>

    <!-- Sizes (Normal Flow) -->
    <div class="mt-4 opacity-0 translate-y-4
                group-hover:opacity-100 
                group-hover:translate-y-0
                transition-all duration-300">

      <div class="grid grid-cols-5 gap-2 mt-3">

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">6</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">7</div>

        <div class="relative h-10 border border-gray-300 rounded-md flex items-center justify-center text-gray-400">
          8
          <span class="absolute w-4/5 h-[1px] bg-gray-300 rotate-[-15deg]"></span>
        </div>

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">9</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">10</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11.5</div>

      </div>
    </div>

  </a>
</div>


      <!-- Slide 5 -->
 <div class="swiper-slide shadow-2xl z-30">
  <a href="#"
     class="relative group block bg-white p-6 pt-10 h-[420px] 
            rounded-2xl shadow-xl overflow-hidden
            transition-all duration-500 
            hover:h-[560px] hover:-translate-y-2">

    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">
      NEW
    </span>

    <img src="/images/sho2.png"
         class="w-full h-48 object-cover rounded-xl"/>
<h4 class="mt-20 text-sm lg:font-semibold text-black">
      MEN'S VARSITY
</h4>


    <p class="text-gray-500 text-sm">
      Classic Everyday Sneaker
    </p>

    <p class="text-black font-semibold">
      $120
    </p>

    <!-- Sizes (Normal Flow) -->
    <div class="mt-4 opacity-0 translate-y-4
                group-hover:opacity-100 
                group-hover:translate-y-0
                transition-all duration-300">

      <div class="grid grid-cols-5 gap-2 mt-3">

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">6</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">7</div>

        <div class="relative h-10 border border-gray-300 rounded-md flex items-center justify-center text-gray-400">
          8
          <span class="absolute w-4/5 h-[1px] bg-gray-300 rotate-[-15deg]"></span>
        </div>

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">9</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">10</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11.5</div>

      </div>
    </div>

  </a>
</div>


      <!-- Slide 6 -->
     <div class="swiper-slide shadow-2xl z-30">
  <a href="#"
     class="relative group block bg-white p-6 pt-10 h-[420px] 
            rounded-2xl shadow-xl overflow-hidden
            transition-all duration-500 
            hover:h-[560px] hover:-translate-y-2">

    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">
      NEW
    </span>

    <img src="/images/sho2.png"
         class="w-full h-48 object-cover rounded-xl"/>
<h4 class="mt-20 text-sm lg:font-semibold text-black">
      MEN'S VARSITY
</h4>


    <p class="text-gray-500 text-sm">
      Classic Everyday Sneaker
    </p>

    <p class="text-black font-semibold">
      $120
    </p>

    <!-- Sizes (Normal Flow) -->
    <div class="mt-4 opacity-0 translate-y-4
                group-hover:opacity-100 
                group-hover:translate-y-0
                transition-all duration-300">

      <div class="grid grid-cols-5 gap-2 mt-3">

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">6</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">7</div>

        <div class="relative h-10 border border-gray-300 rounded-md flex items-center justify-center text-gray-400">
          8
          <span class="absolute w-4/5 h-[1px] bg-gray-300 rotate-[-15deg]"></span>
        </div>

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">9</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">10</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11.5</div>

      </div>
    </div>

  </a>
</div>


      <!-- Slide 7 -->
   <div class="swiper-slide shadow-2xl z-30">
  <a href="#"
     class="relative group block bg-white p-6 pt-10 h-[420px] 
            rounded-2xl shadow-xl overflow-hidden
            transition-all duration-500 
            hover:h-[560px] hover:-translate-y-2">

    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full">
      NEW
    </span>

    <img src="/images/sho2.png"
         class="w-full h-48 object-cover rounded-xl"/>

   <h4 class="mt-20 text-sm lg:font-semibold text-black">
      MEN'S VARSITY
</h4>


    <p class="text-gray-500 text-sm">
      Classic Everyday Sneaker
    </p>

    <p class="text-black font-semibold">
      $120
    </p>

    <!-- Sizes (Normal Flow) -->
    <div class="mt-4 opacity-0 translate-y-4
                group-hover:opacity-100 
                group-hover:translate-y-0
                transition-all duration-300">

      <div class="grid grid-cols-5 gap-2 mt-3">

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">6</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">7</div>

        <div class="relative h-10 border border-gray-300 rounded-md flex items-center justify-center text-gray-400">
          8
          <span class="absolute w-4/5 h-[1px] bg-gray-300 rotate-[-15deg]"></span>
        </div>

        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">9</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">10</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11</div>
        <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-100">11.5</div>

      </div>
    </div>

  </a>
</div>



    </div>
  </div>

</section>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 30,
    loop: true,
    speed: 800,
    grabCursor: true,
    navigation: {
      nextEl: ".custom-next",
      prevEl: ".custom-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1 },
      640: { slidesPerView: 2 },
      1024: { slidesPerView: 4 }
    }
  });
</script>

<!-- Tailwind Utility Classes Shortcut -->
<style>
.card-style {
  @apply relative block bg-white p-6 pt-10 h-[420px] rounded-2xl shadow-xl overflow-hidden
  transition-all duration-500 ease-out hover:h-[520px] hover:-translate-y-2;
}
.badge {
  @apply absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full;
}
.card-img {
  @apply w-full h-48 object-cover rounded-xl;
}
.card-title {
  @apply mt-20 text-sm font-semibold text-black;
}
.card-desc {
  @apply text-gray-500 text-sm;
}
.card-price {
  @apply text-black font-semibold;
}
</style>



<!-- bottom -->
 <section class="relative w-full h-[60vh] md:h-[80vh] bg-cover bg-center rounded-2xl overflow-hidden"
         style="background-image: url('/images/animalbg.webp');">

  <!-- Content -->
  <div class="relative w-full h-full flex flex-col justify-center items-center text-center px-4 text-white">

    <!-- Circles container -->
    <div id="circlesWrapper" class="absolute w-[90%] max-w-[600px] aspect-[550/420] md:w-[600px] md:h-[420px] flex justify-center items-center">

      <!-- Circles (ovals using border radius 50% / 50%) -->
      <div class="absolute border border-white rounded-full w-full h-full"></div>
      <div class="absolute border border-white rounded-full w-[94%] h-[90%]"></div>
      <div class="absolute border border-white bg-white/10 rounded-full w-[87%] h-[80%]"></div>

      <!-- Balls container -->
      <div id="ballsContainer" class="absolute w-full h-full top-0 left-0 z-20"></div>

      <!-- Labels -->
      <span class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 md:-top-4 md:-left-6 bg-transparent border border-white text-white text-xs px-2 py-1 rounded-full">RENEWABLE MATERIALS</span>
      <span class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 md:-top-4 md:-right-6 border border-white text-white text-xs px-2 py-1 rounded-full">RESPONSIBLE ENERGY</span>
      <span class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 md:-bottom-4 md:-right-6 border border-white text-white text-xs px-2 py-1 rounded-full">REGENERATIVE AGRICULTURE</span>
    </div>

    <!-- Main Text -->
    <h4 class="text-lg md:text-xl mb-2 font-semibold">Better Things in a Better Way</h4>
    <p class="text-xs md:text-sm mb-4 font-serif">Looking to the world's greatest innovator - Nature</p>
   
    <!-- Button -->
    <a href="#" class="bg-white text-black px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-gray-200 transition">Learn More</a>

  </div>
</section>

<script>
function placeBalls() {
  const container = document.getElementById('ballsContainer');
  const wrapper = document.getElementById('circlesWrapper');
  container.innerHTML = ''; // clear previous balls

  const rect = wrapper.getBoundingClientRect();
  const cx = rect.width / 2;
  const cy = rect.height / 2;

  // Circles radii relative to original 550x420
  const baseCircles = [
    {rx: 275, ry: 210, balls: 3}, // outer
   
  ];

  const scaleX = rect.width / 550;
  const scaleY = rect.height / 420;

  baseCircles.forEach(circle => {
    for (let i = 0; i < circle.balls; i++) {
      const angle = Math.random() * 2 * Math.PI;
      const x = cx + circle.rx * Math.cos(angle) * scaleX - 5;
      const y = cy + circle.ry * Math.sin(angle) * scaleY - 5;

      const ball = document.createElement('div');
      ball.className = "w-3 h-3 bg-white rounded-full absolute";
      ball.style.left = `${x}px`;
      ball.style.top = `${y}px`;
      container.appendChild(ball);
    }
  });
}

// Run on load and resize
window.addEventListener('load', placeBalls);
window.addEventListener('resize', placeBalls);
</script>
<style>
  .animate-orbit {
    top:50%;
    left:50%;
    transform-origin: center center;
    animation: orbit var(--duration,8s) linear infinite;
    animation-delay: var(delay,4s);
  }

  @keyframes orbit {
    0% {
      transform: rotate(0deg) translateX(var(--rx)) translateY(calc(var(--ry) - var(--rx))) rotate(0deg);
    }
    100% {
      transform: rotate(360deg) translateX(var(--rx)) translateY(calc(var(--ry) - var(--rx))) rotate(-360deg);
    }
  }

</style>




<!-- last section -->

<section class="max-w-full px-6 py-8 mx-auto grid 
                grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 
                gap-6 mt-8">

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