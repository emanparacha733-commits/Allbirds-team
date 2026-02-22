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
    $displayPrice = ($product->on_sale && $product->sale_price) ? $product->sale_price : $product->price;
    $displayPriceFormatted = number_format($displayPrice, 0);
@endphp

<style>
  html, body { overflow-x: hidden !important; max-width: 100%; background-color: #eae7e1; }

  /* PAGE LAYOUT - Expanded Left Panel */
  .page-wrapper {
    display: grid;
    grid-template-columns: 1.6fr 0.9fr; /* Increased image column ratio */
    gap: 3.5rem;
    align-items: start;
    max-width: 1650px; /* Increased max width to allow larger visuals */
    margin: 0 auto;
    padding: 1.5rem 2.5rem 0;
  }
  @media (max-width: 1150px) { 
    .page-wrapper { grid-template-columns: 1fr; gap: 2rem; padding: 1rem; } 
  }

  /* IMAGE COLUMN - High Visibility */
  .img-col {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
  }
  .img-top-row { 
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    gap: 12px; 
    width: 100%; 
  }
  .img-top-row img, .img-top-row .img-placeholder {
    width: 100%; 
    max-height: auto;  /* shorter height */
    height: auto;        /* maintain proportion */
    object-fit: contain; /* show full image, no cropping */
    border-radius: 16px; 
    background: #dedad4; 
    display: block;
    transition: transform 0.4s ease;
}
  .img-top-row img:hover {
    transform: scale(1.01); /* Subtle zoom for engagement */
  }
  .img-placeholder { display: flex; align-items: center; justify-content: center; color: #999; font-size: 0.9rem; }

  /* BADGE */
  .badge-new {
    display: inline-block; background: #fff; border: 1.5px solid #111;
    border-radius: 999px; font-size: 0.75rem; font-weight: 700;
    padding: 5px 16px; margin-bottom: 12px; letter-spacing: 0.05em;
    width: fit-content;
  }

  /* RIGHT PANEL - Sticky & Compact */
  .product-panel {
    background: #fff; border-radius: 24px; padding: 2.5rem;
    position: sticky; top: 2rem; box-shadow: 0 4px 30px rgba(0,0,0,0.06);
    display: flex; flex-direction: column;
  }
  .product-panel h1 {
    font-family: Georgia, serif; font-size: 2.2rem; font-weight: 400;
    line-height: 1.2; color: #111; margin: 0 0 0.5rem;
  }

  /* PRICE */
  .product-price { font-size: 1.3rem; font-weight: 600; color: #111; margin-bottom: 1.5rem; }
  .product-price .sale { color: #c00; }
  .product-price .original { color: #999; text-decoration: line-through; margin-left: 8px; font-weight: 400; font-size: 1.1rem; }

  /* FILTER TABS */
  .filter-tabs { display: flex; gap: 1.5rem; margin-bottom: 1.2rem; border-bottom: 1.5px solid #e5e5e5; padding-bottom: 0.7rem; }
  .filter-tab {
    font-size: 0.83rem; font-weight: 500; color: #aaa; cursor: pointer;
    padding-bottom: 6px; border-bottom: 2.5px solid transparent; margin-bottom: -9px;
    letter-spacing: 0.04em; transition: color 0.15s, border-color 0.15s; user-select: none;
  }
  .filter-tab.active { color: #111; border-bottom-color: #111; font-weight: 700; }

  /* COLOR */
  .color-label { font-size: 0.88rem; color: #333; margin-bottom: 0.6rem; }
  .swatches-row { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 1.4rem; }
  .swatch-outer {
    width: 38px; height: 38px; border-radius: 50%; border: 2.5px solid transparent;
    padding: 3px; cursor: pointer; transition: border-color 0.15s; box-sizing: border-box;
  }
  .swatch-outer:hover { border-color: #888; }
  .swatch-outer.active { border-color: #111; }
  .swatch-inner { width: 100%; height: 100%; border-radius: 50%; border: 1px solid rgba(0,0,0,0.15); display: block; }

  /* SIZE GRID */
  #sizeGrid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 0.6rem; }
  .size-btn {
    border: 1.5px solid #d1d5db; padding: 0.85rem 0.25rem; font-size: 0.92rem;
    font-weight: 600; border-radius: 10px; cursor: pointer; background: #fff;
    color: #111; transition: all 0.15s; text-align: center;
  }
  .size-btn:hover { border-color: #111; background: #f5f5f5; }
  .size-btn.selected { background: #111; color: #fff; border-color: #111; }

  /* FIT NOTE */
  .fit-note { font-size: 0.8rem; color: #666; margin-bottom: 1.4rem; line-height: 1.5; margin-top: 0.6rem; }
  .fit-note button { color: #111; text-decoration: underline; background: none; border: none; cursor: pointer; font-size: inherit; padding: 0; display: block; margin-top: 2px; }

  /* ADD TO CART */
  #selectSizeBtn {
    width: 100%; border-radius: 999px; padding: 1.1rem 0; font-size: 0.92rem;
    font-weight: 700; letter-spacing: 0.07em; border: none; cursor: pointer; transition: background 0.2s, color 0.2s;
  }
  #selectSizeBtn:disabled { background: #e5e5e5; color: #aaa; cursor: not-allowed; }
  #selectSizeBtn:not(:disabled) { background: #111; color: #fff; }
  #selectSizeBtn:not(:disabled):hover { background: #333; }

  .shipping-note { text-align: center; font-size: 0.78rem; color: #999; margin-top: 1.1rem; line-height: 1.7; }

  /* ACCORDION */
  .accordion-wrap { width: 100%; margin: 2.5rem 0 0; padding: 0 2rem; }
  .accordion-item { background: #fff; border-radius: 18px; border: 1px solid #e0ddd8; margin-bottom: 0.75rem; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.05); }
  .accordion-btn {
    width: 100%; display: flex; justify-content: space-between; align-items: center;
    padding: 1.6rem 2rem; font-family: 'Courier New', monospace; font-size: 0.82rem;
    letter-spacing: 0.1em; text-align: left; color: #111; background: transparent; border: none; cursor: pointer; transition: background 0.2s;
  }
  .accordion-btn:hover { background: #fafaf8; }
  .accordion-body { display: none; padding: 0 2rem 2.5rem; background: #fff; }
  .accordion-body.open { display: block; }
  .accordion-icon { font-size: 1.3rem; font-weight: 300; line-height: 1; color: #555; }

  /* WHY WE MADE THIS */
  .why-grid {
    display: grid;
    grid-template-columns: 1fr 420px 1fr;
    gap: 4rem;
    align-items: center;
    padding: 2rem 0 1rem;
  }
  @media (max-width: 900px) { .why-grid { grid-template-columns: 1fr; } .why-circle-wrap { order: -1; } }

  /* BIG CIRCULAR IMAGE */
  .why-circle {
    width: 380px; height: 380px; border-radius: 50%;
    background: #f0ede8; display: flex; align-items: center; justify-content: center;
    margin: 0 auto;
    box-shadow: 0 0 0 14px #e8e4de, 0 0 0 28px #dedad4;
  }
  .why-circle img { width: 300px; height: 300px; object-fit: contain; border-radius: 50%; transition: opacity 0.3s; }

  /* WHY LEFT */
  .why-left { display: flex; flex-direction: column; gap: 1.4rem; }
  .why-left > p { font-size: 1rem; line-height: 1.75; color: #333; }
  .best-for-label { font-size: 0.72rem; letter-spacing: 0.1em; color: #888; margin-bottom: 0.5rem; font-family: 'Courier New', monospace; }
  .why-tags { display: flex; flex-wrap: wrap; gap: 8px; }
  .why-tags span { background: #f0ede8; border-radius: 999px; font-size: 0.82rem; padding: 5px 14px; color: #555; }
  .tech-toggle { font-size: 0.82rem; color: #555; background: none; border: none; cursor: pointer; padding: 0; display: flex; align-items: center; gap: 6px; text-decoration: underline; text-underline-offset: 3px; }
  .tech-list { margin-top: 0.8rem; display: flex; flex-direction: column; gap: 4px; font-size: 0.85rem; color: #444; line-height: 1.6; }

  /* WHY RIGHT */
  .why-right { display: flex; flex-direction: column; gap: 1rem; }
  .why-section-label { font-size: 0.72rem; letter-spacing: 0.12em; color: #888; margin-bottom: 0.5rem; font-family: 'Courier New', monospace; }
  .why-right ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem; }
  .why-right ul li { font-size: 0.92rem; color: #444; line-height: 1.55; padding-left: 1rem; position: relative; }
  .why-right ul li::before { content: '•'; position: absolute; left: 0; color: #bbb; }
  .why-right ul li strong { color: #111; font-weight: 700; }
</style>


<div class="page-wrapper">

  <div class="img-col">
    <span class="badge-new">{{ $product->is_new ? 'NEW' : ($product->on_sale ? 'SALE' : 'IN STOCK') }}</span>
    <div class="img-top-row">
      <img id="mainImage" src="{{ $product->image_url }}" alt="{{ $product->name }}">
      @if($product->image_2)
        <img src="{{ asset('storage/' . $product->image_2) }}" alt="{{ $product->name }} view 2">
      @else
        <div class="img-placeholder">No image</div>
      @endif
    </div>
  </div>

  <div class="product-panel">
    <h1>{{ $product->name }}</h1>

    <div class="product-price">
      @if($product->on_sale && $product->sale_price)
        <span class="sale">${{ number_format($product->sale_price, 0) }}</span>
        <span class="original">${{ number_format($product->price, 0) }}</span>
      @else
        ${{ number_format($product->price, 0) }}
      @endif
    </div>

    <div class="filter-tabs">
      <span class="filter-tab active" data-tab="all">ALL</span>
      <span class="filter-tab" data-tab="classic">CLASSIC</span>
      <span class="filter-tab" data-tab="limited">LIMITED</span>
      <span class="filter-tab" data-tab="3packs">3PACKS</span>
    </div>

    <p class="color-label" id="colorLabel">
      @if(!empty($colorVariants))
        {{ $colorVariants[0]['color_name'] ?? $product->color_name ?? '' }}
      @else
        {{ $product->color_name ?? '' }}
      @endif
    </p>

    <div class="swatches-row" id="swatchesRow">
      @if(!empty($colorVariants))
        @foreach($colorVariants as $i => $variant)
          @php
            $imgUrl    = !empty($variant['image']) ? asset('storage/'.$variant['image']) : '';
            $colorName = $variant['color_name'] ?? '';
            $colorHex  = $variant['color_hex'] ?? '#000';
          @endphp
          <div class="swatch-outer {{ $i === 0 ? 'active' : '' }}"
               data-color-name="{{ $colorName }}"
               data-img-src="{{ $imgUrl }}"
               title="{{ $colorName }}">
            <span class="swatch-inner" style="background-color: {{ $colorHex }};"></span>
          </div>
        @endforeach
      @elseif($product->color_hex)
        <div class="swatch-outer active" data-color-name="{{ $product->color_name ?? '' }}" data-img-src="">
          <span class="swatch-inner" style="background-color: {{ $product->color_hex }};"></span>
        </div>
      @endif
    </div>

    <div id="sizeGrid">
      @forelse($product->available_sizes as $size)
        <button class="size-btn" data-tab="all classic">{{ $size }}</button>
      @empty
        <p style="grid-column:span 4;font-size:0.85rem;color:#aaa;padding:0.5rem 0;">Sizes not available</p>
      @endforelse
    </div>

    <p class="fit-note">
      Fits true to size. We suggest sizing up if you want something roomier.
      <button id="openFitGuide">Fit Guide</button>
    </p>

    <button id="selectSizeBtn" disabled>SELECT A SIZE</button>

    <p class="shipping-note">Free Shipping on Orders over $75<br>Easy Returns</p>
  </div>
</div>


<div class="accordion-wrap">

  <div class="accordion-item">
    <button class="accordion-btn" onclick="toggleAccordion(this)">
      <span>WHY WE MADE THIS</span>
      <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-body">
      <div class="why-grid">

        <div class="why-left">
          <p>{{ $product->description ?? 'The Anytime No Show Heel Grip sock is an evolution of our lowest profile sock silhouette. A new silicone grip hugs your heel to prevent the sock from sliding down into your shoe. This lightweight sock is designed to be comfortable but also stay out of sight. The go-to style when you want a lightweight feel and barefoot look.' }}</p>
          <div>
            <p class="best-for-label">BEST FOR</p>
            <div class="why-tags">
              <span>Everyday</span>
              <span>Walking</span>
              <span>Workouts</span>
              <span>Commuting</span>
              <span>Light Jogging</span>
            </div>
          </div>
          <div>
            <button class="tech-toggle" onclick="toggleTech(this)">
              <span class="tech-arrow">›</span>
              <span class="tech-label">View technical details</span>
            </button>
            <div class="tech-list" style="display:none;">
              <span><strong>Weight:</strong> 10.9oz (M9) / 9.0oz (W7)</span>
              <span><strong>Heel/Toe Drop:</strong> 7mm</span>
              <span><strong>Stack Height:</strong> Heel: 22.9mm, Toe: 15.9mm</span>
              <span><strong>Country of Origin:</strong> Vietnam</span>
            </div>
          </div>
        </div>

        <div class="why-circle-wrap" style="display:flex;justify-content:center;">
          <div class="why-circle">
            <img id="whyCircleImg" src="{{ $product->image_url }}" alt="{{ $product->name }}">
          </div>
        </div>

        <div class="why-right">
          <p class="why-section-label">THOUGHTFULLY DESIGNED</p>
          <ul>
            <li><strong>Light &amp; Breathable Yarn Blend</strong> - our lightweight yarns make the No Show style a warm weather favorite</li>
            <li><strong>Designed to Stay Hidden</strong> - the light feel and low profile cut keep this sock out of sight and out of mind</li>
            <li><strong>No Slip Silicone Grip</strong> - a small silicone heel grip prevents the sock from sliding down into your shoe</li>
            <li><strong>Supportive Arch</strong> - an elastic arch band provides gentle support for all day comfort</li>
            <li><strong>Manufactured in the U.S</strong> - all of our Allbirds socks are proudly knit in North Carolina</li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <div class="accordion-item">
    <button class="accordion-btn" onclick="toggleAccordion(this)">
      <span>MATERIALS &amp; SUSTAINABILITY</span>
      <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-body">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-4 text-sm text-gray-600 leading-relaxed">
        <p><strong>Upper:</strong> Tree Knit – TENCEL® Lyocell and recycled polyester</p>
        <p><strong>Midsole:</strong> SweetFoam® – Sugarcane-based EVA foam</p>
        <p><strong>Outsole:</strong> Natural rubber – For durability and traction</p>
        <p><strong>Laces:</strong> 100% recycled polyester from plastic bottles</p>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <button class="accordion-btn" onclick="toggleAccordion(this)">
      <span>CARE INSTRUCTIONS</span>
      <span class="accordion-icon">+</span>
    </button>
    <div class="accordion-body">
      <p class="text-sm text-gray-600 py-3 leading-relaxed">
        Yes, they're machine washable. Remove the insoles, hand wash those separately, and let everything air dry. Do not tumble dry or iron.
      </p>
    </div>
  </div>

</div>

<div id="fitModal" class="fixed inset-0 bg-black/50 flex items-center justify-center opacity-0 invisible transition-all duration-300 z-50">
  <div class="bg-white w-[95%] max-w-5xl rounded-2xl p-6 relative transform scale-95 transition-all duration-300" id="modalContent">
    <button id="closeFitGuide" class="absolute top-4 right-4 text-2xl font-light">&times;</button>
    <h2 class="text-2xl font-semibold text-center mb-2">{{ $product->name }}</h2>
    <div class="w-full flex justify-center mt-2 mb-4">
      <p class="bg-red-100 inline-block px-4 py-2 rounded-full text-sm">Fits true-to-size for most customers.</p>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-6">
      <img src="{{ $product->image_url }}" alt="Front View" class="rounded-xl max-h-60 w-full object-cover">
      <img src="{{ $product->image_url }}" alt="Side View"  class="rounded-xl max-h-60 w-full object-cover opacity-80">
    </div>
    <div class="overflow-x-auto rounded-2xl border border-gray-200">
      <table class="w-full text-center text-sm border-collapse">
        <thead>
          <tr>
            <th class="px-3 py-2 border border-gray-200 bg-red-100">US</th>
            @foreach(['8','8.5','9','9.5','10','10.5','11','11.5','12','12.5','13','13.5','14'] as $s)
            <th class="px-3 py-2 border border-gray-200 bg-gray-50">{{ $s }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="px-3 py-2 border border-gray-200 bg-red-100">UK</td>
            @foreach(['7','7.5','8','8.5','9','9.5','10','10.5','11','11.5','12','12.5','13'] as $s)
            <td class="px-3 py-2 border border-gray-200">{{ $s }}</td>
            @endforeach
          </tr>
          <tr>
            <td class="px-3 py-2 border border-gray-200 bg-red-100">cm</td>
            @foreach(['26','26.5','27','27.5','28','28.5','29','29.5','30','30.5','31','31.5','32'] as $s)
            <td class="px-3 py-2 border border-gray-200 bg-gray-50">{{ $s }}</td>
            @endforeach
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<section style="width:100%;margin:3rem 0 0;padding:0 2rem;">
  <div style="background:#7C8C52;border-radius:20px;padding:4rem 2rem;text-align:center;">
    <p style="color:#fff;font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.5rem;">The {{ $product->name }} Collection</p>
    <h1 style="color:#fff;font-size:3rem;font-family:Georgia,serif;font-weight:400;margin:1rem 0 2rem;">Comfort That Keeps Up</h1>
    <a href="{{ url('/men/shoes') }}"
       style="display:inline-block;border:2px solid #fff;color:#fff;font-weight:700;padding:0.8rem 2.5rem;border-radius:999px;text-decoration:none;font-size:0.9rem;"
       onmouseover="this.style.background='#fff';this.style.color='#000'"
       onmouseout="this.style.background='transparent';this.style.color='#fff'">
      Shop Now
    </a>
  </div>
</section>

<section style="width:100%;margin:3rem 0 0;padding:0 2rem;">
  <div style="position:relative;width:100%;height:70vh;background:url('/images/animalbg.webp') center/cover no-repeat;border-radius:20px;overflow:hidden;">
    <div style="position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;color:#fff;padding:2rem;">
      <div id="circlesWrapper" style="position:absolute;width:min(90%,560px);aspect-ratio:550/420;display:flex;justify-content:center;align-items:center;">
        <div style="position:absolute;width:100%;height:100%;border:1px solid rgba(255,255,255,0.6);border-radius:50%;"></div>
        <div style="position:absolute;width:94%;height:90%;border:1px solid rgba(255,255,255,0.4);border-radius:50%;"></div>
        <div style="position:absolute;width:87%;height:80%;border:1px solid rgba(255,255,255,0.3);background:rgba(255,255,255,0.05);border-radius:50%;"></div>
        <div id="ballsContainer" style="position:absolute;width:100%;height:100%;top:0;left:0;"></div>
        <span style="position:absolute;top:0;left:0;transform:translate(-50%,-50%);border:1px solid #fff;font-size:0.7rem;padding:4px 10px;border-radius:999px;white-space:nowrap;">RENEWABLE MATERIALS</span>
        <span style="position:absolute;top:0;right:0;transform:translate(50%,-50%);border:1px solid #fff;font-size:0.7rem;padding:4px 10px;border-radius:999px;white-space:nowrap;">RESPONSIBLE ENERGY</span>
        <span style="position:absolute;bottom:0;right:0;transform:translate(50%,50%);border:1px solid #fff;font-size:0.7rem;padding:4px 10px;border-radius:999px;white-space:nowrap;">REGENERATIVE AGRICULTURE</span>
      </div>
      <h4 style="font-size:1.2rem;font-weight:600;margin-bottom:0.5rem;position:relative;z-index:1;">Better Things in a Better Way</h4>
      <p style="font-size:0.9rem;font-family:Georgia,serif;margin-bottom:1.5rem;position:relative;z-index:1;">Looking to the world's greatest innovator - Nature</p>
      <a href="#" style="background:#fff;color:#111;padding:0.7rem 1.8rem;border-radius:999px;text-decoration:none;font-weight:600;font-size:0.85rem;position:relative;z-index:1;">Learn More</a>
    </div>
  </div>
</section>


<section style="width:100%;margin:2rem 0;padding:0 2rem;display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;">
  <div style="background:#fff;border-radius:18px;box-shadow:0 4px 16px rgba(0,0,0,0.07);padding:1.75rem;">
    <p style="font-size:1.1rem;color:#111;font-weight:500;margin-bottom:0.5rem;">Wear All Day Comfort</p>
    <p style="color:#666;font-size:0.88rem;line-height:1.6;">Lightweight, bouncy, and wildly comfortable, Allbirds shoes make any outing feel effortless.</p>
  </div>
  <div style="background:#fff;border-radius:18px;box-shadow:0 4px 16px rgba(0,0,0,0.07);padding:1.75rem;">
    <p style="font-size:1.1rem;color:#111;font-weight:500;margin-bottom:0.5rem;">Sustainability In Every Step</p>
    <p style="color:#666;font-size:0.88rem;line-height:1.6;">From materials to transport, we're working to reduce our carbon footprint to near zero.</p>
  </div>
  <div style="background:#fff;border-radius:18px;box-shadow:0 4px 16px rgba(0,0,0,0.07);padding:1.75rem;">
    <p style="font-size:1.1rem;color:#111;font-weight:500;margin-bottom:0.5rem;">Materials From The Earth</p>
    <p style="color:#666;font-size:0.88rem;line-height:1.6;">We replace petroleum-based synthetics with natural alternatives wherever we can.</p>
  </div>
</section>


<form id="addToCartForm" action="{{ route('cart.add') }}" method="POST" style="display:none;">
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}">
  <input type="hidden" name="name"       value="{{ $product->name }}">
  <input type="hidden" name="price"      value="{{ $product->on_sale && $product->sale_price ? $product->sale_price : $product->price }}">
  <input type="hidden" name="image"      value="{{ $product->image_url }}">
  <input type="hidden" name="size"       id="formSize" value="">
</form>


<script>
document.addEventListener("DOMContentLoaded", function () {

  /* Accordion */
  window.toggleAccordion = function(btn) {
    const body = btn.nextElementSibling;
    const icon = btn.querySelector('.accordion-icon');
    const isOpen = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    icon.textContent = isOpen ? '+' : '−';
  };

  /* Tech details */
  window.toggleTech = function(btn) {
    const list  = btn.parentElement.querySelector('.tech-list');
    const arrow = btn.querySelector('.tech-arrow');
    const label = btn.querySelector('.tech-label');
    const hidden = list.style.display === 'none' || !list.style.display;
    list.style.display = hidden ? 'flex' : 'none';
    arrow.textContent  = hidden ? '‹' : '›';
    label.textContent  = hidden ? 'Hide technical details' : 'View technical details';
  };

  /* Color swatches — updates mainImage AND whyCircleImg */
  const swatchesRow = document.getElementById('swatchesRow');
  if (swatchesRow) {
    swatchesRow.addEventListener('click', function(e) {
      const outer = e.target.closest('.swatch-outer');
      if (!outer) return;
      swatchesRow.querySelectorAll('.swatch-outer').forEach(s => s.classList.remove('active'));
      outer.classList.add('active');
      const name   = outer.dataset.colorName || '';
      const imgSrc = outer.dataset.imgSrc    || '';
      document.getElementById('colorLabel').textContent = name;
      if (imgSrc) {
        document.getElementById('mainImage').src = imgSrc;
        const circleImg = document.getElementById('whyCircleImg');
        if (circleImg) {
          circleImg.style.opacity = '0';
          setTimeout(() => { circleImg.src = imgSrc; circleImg.style.opacity = '1'; }, 220);
        }
      }
    });
  }

  /* Filter tabs */
  const tabs        = document.querySelectorAll('.filter-tab');
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
      tabs.forEach(t => t.classList.remove('active'));
      tabEl.classList.add('active');
      filterSizes(tabEl.dataset.tab);
    });
  });

  /* Size + Add to Cart */
  const sizeGrid  = document.getElementById('sizeGrid');
  const selectBtn = document.getElementById('selectSizeBtn');
  let selectedSize = null;
  if (sizeGrid) {
    sizeGrid.addEventListener('click', function(e) {
      const btn = e.target.closest('button.size-btn');
      if (!btn || btn.disabled) return;
      sizeGrid.querySelectorAll('button.size-btn').forEach(b => b.classList.remove('selected'));
      btn.classList.add('selected');
      selectedSize = btn.textContent.trim();
      selectBtn.disabled = false;
      selectBtn.textContent = `ADD TO CART - $${{ $displayPriceFormatted }}`;
    });
  }
  selectBtn.addEventListener('click', function() {
    if (!selectedSize) return;
    document.getElementById('formSize').value = selectedSize;
    document.getElementById('addToCartForm').submit();
  });

  /* Fit Guide Modal */
  const openBtn      = document.getElementById('openFitGuide');
  const closeBtn     = document.getElementById('closeFitGuide');
  const modal        = document.getElementById('fitModal');
  const modalContent = document.getElementById('modalContent');
  if (openBtn && modal) {
    function openModal() {
      modal.classList.remove('opacity-0','invisible');
      modal.classList.add('opacity-100','visible');
      modalContent.classList.remove('scale-95');
      modalContent.classList.add('scale-100');
    }
    function closeModal() {
      modal.classList.remove('opacity-100','visible');
      modal.classList.add('opacity-0','invisible');
      modalContent.classList.remove('scale-100');
      modalContent.classList.add('scale-95');
    }
    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
  }

  /* Swiper */
  if (typeof Swiper !== 'undefined') {
    new Swiper('.mySwiper', {
      slidesPerView: 4, spaceBetween: 24, loop: true, speed: 800, grabCursor: true,
      navigation: { nextEl: '.custom-next', prevEl: '.custom-prev' },
      breakpoints: { 0: { slidesPerView: 1 }, 640: { slidesPerView: 2 }, 1024: { slidesPerView: 4 } },
    });
  }

  /* Nature circles */
  function placeBalls() {
    const container = document.getElementById('ballsContainer');
    const wrapper   = document.getElementById('circlesWrapper');
    if (!container || !wrapper) return;
    container.innerHTML = '';
    const rect = wrapper.getBoundingClientRect();
    const cx = rect.width / 2, cy = rect.height / 2;
    const scaleX = rect.width / 550, scaleY = rect.height / 420;
    for (let i = 0; i < 3; i++) {
      const angle = Math.random() * 2 * Math.PI;
      const x = cx + 275 * Math.cos(angle) * scaleX - 5;
      const y = cy + 210 * Math.sin(angle) * scaleY - 5;
      const ball = document.createElement('div');
      ball.style.cssText = `width:10px;height:10px;background:#fff;border-radius:50%;position:absolute;left:${x}px;top:${y}px;`;
      container.appendChild(ball);
    }
  }
  window.addEventListener('load', placeBalls);
  window.addEventListener('resize', placeBalls);

});
</script>

</x-layouts>