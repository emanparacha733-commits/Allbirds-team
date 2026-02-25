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

  /* PAGE LAYOUT */
  .page-wrapper {
    display: grid;
    grid-template-columns: 1.3fr 1.1fr;
    gap: 2rem;
    align-items: start;
    max-width: calc(100% - 24px);  /* 2px margin each side */
    margin: 0 auto;
    padding: 2rem 4px 0;        /* 2px left/right margin from edges */
  }
  @media (max-width: 1150px) { 
    .page-wrapper { grid-template-columns: 1fr; gap: 2rem; padding: 1rem 2px; } 
  }

  /* IMAGE COLUMN */
  .img-col {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
    margin-left: 2px;             /* 2px from left edge */
  }
  .img-top-row { 
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    gap: 12px; 
    width: 100%;
    flex: 1;                      /* stretch to fill height */
  }
  .img-top-row img, .img-top-row .img-placeholder {
    width: 100%; 
    height: auto;           /* tall images */
    object-fit: contain;
    border-radius: 16px; 
    background: #dedad4; 
    display: block;
    transition: transform 0.4s ease;
  }
  .img-top-row img:hover {
    transform: scale(1.01);
  }
  .img-placeholder { 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    color: #999; 
    font-size: 0.9rem; 
            
    height: auto;
    border-radius: 16px;
    background: #dedad4;
  }
  .img-placeholder img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 16px;
    opacity: 0.6;
  }

  /* BADGE */
  .badge-new {
    display: inline-block; background: #fff; border: 1.5px solid #111;
    border-radius: 999px; font-size: 0.75rem; font-weight: 700;
    padding: 5px 16px; margin-bottom: 12px; letter-spacing: 0.05em;
    width: fit-content;
  }

  /* RIGHT PANEL */
  .product-panel {
    background: #fff; border-radius: 24px; padding: 2.5rem 2.5rem 10rem;
    position: sticky; top: 2rem; box-shadow: 0 4px 30px rgba(0,0,0,0.06);
    display: flex; flex-direction: column;
    margin-right: 0px;
    min-height: 640px;
    justify-content: space-between;
  }
  .product-panel h1 {
    font-family: Georgia, serif; font-size: 2.2rem; font-weight: 400;
    line-height: 1.2; color: #111; margin: 0 0 0.5rem;
  }
  .product-panel h2 {
    font-family: inherit; font-weight: inherit;
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

  /* WHY WE MADE THIS — Taller & More Spacious */
  .why-grid {
    display: grid;
    grid-template-columns: 1fr 480px 1fr;
    gap: 4rem;
    align-items: center;
    padding: 3rem 0 3rem; /* increased top/bottom padding */
    min-height: 520px;    /* enforces taller section */
  }
  @media (max-width: 900px) { .why-grid { grid-template-columns: 1fr; min-height: auto; } .why-circle-wrap { order: -1; } }

  /* BIG CIRCULAR IMAGE — larger */
  .why-circle {
    width: 440px; height: 440px; border-radius: 50%;
    background: #f0ede8; display: flex; align-items: center; justify-content: center;
    margin: 0 auto;
    box-shadow: 0 0 0 16px #e8e4de, 0 0 0 32px #dedad4;
  }
  .why-circle img { width: 360px; height: 360px; object-fit: contain; border-radius: 50%; transition: opacity 0.3s; }

  /* WHY LEFT */
  .why-left { display: flex; flex-direction: column; gap: 1.8rem; } /* increased gap */
  .why-left > p { font-size: 1rem; line-height: 1.85; color: #333; } /* taller line height */
  .best-for-label { font-size: 0.72rem; letter-spacing: 0.1em; color: #888; margin-bottom: 0.5rem; font-family: 'Courier New', monospace; }
  .why-tags { display: flex; flex-wrap: wrap; gap: 8px; }
  .why-tags span { background: #f0ede8; border-radius: 999px; font-size: 0.82rem; padding: 5px 14px; color: #555; }
  .tech-toggle { font-size: 0.82rem; color: #555; background: none; border: none; cursor: pointer; padding: 0; display: flex; align-items: center; gap: 6px; text-decoration: underline; text-underline-offset: 3px; }
  .tech-list { margin-top: 0.8rem; display: flex; flex-direction: column; gap: 4px; font-size: 0.85rem; color: #444; line-height: 1.6; }

  /* WHY RIGHT */
  .why-right { display: flex; flex-direction: column; gap: 1.2rem; } /* increased gap */
  .why-section-label { font-size: 0.72rem; letter-spacing: 0.12em; color: #888; margin-bottom: 0.5rem; font-family: 'Courier New', monospace; }
  .why-right ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1.4rem; } /* increased gap */
  .why-right ul li { font-size: 0.92rem; color: #444; line-height: 1.65; padding-left: 1rem; position: relative; } /* taller line height */
  .why-right ul li::before { content: '•'; position: absolute; left: 0; color: #bbb; }
  .why-right ul li strong { color: #111; font-weight: 700; }
</style>


<div class="page-wrapper">

  <div class="img-col">
    <h1 class="badge-new">{{ $product->is_new ? 'NEW' : ($product->on_sale ? 'SALE' : 'IN STOCK') }}</h1>
    <div class="img-top-row">
      <img id="mainImage" src="{{ $product->image_url }}" alt="{{ $product->name }}">

      {{-- FIX: wrapped in secondImageSlot so JS can replace contents on color switch --}}
      <div id="secondImageSlot">
        @if($product->image_2 && $product->image_2 !== $product->image)
          <img id="secondImage" src="{{ asset('storage/' . $product->image_2) }}" alt="{{ $product->name }} view 2"
               onerror="this.parentElement.innerHTML='<div class=\'img-placeholder\'>No second image available</div>'">
        @else
          <div class="img-placeholder">
            <img id="secondImage" src="{{ $product->image_url }}" alt="{{ $product->name }} alternate view" style="opacity:0.6;">
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="product-panel">
    <h1>{{ $product->name }}</h1>

    <div class="product-price">
      @if($product->on_sale && $product->sale_price)
        <h2 class="sale">${{ number_format($product->sale_price, 0) }}</h2>
        <h2 class="original">${{ number_format($product->price, 0) }}</h2>
      @else
        <h2>${{ number_format($product->price, 0) }}</h2>
      @endif
    </div>

    <div class="filter-tabs">
      <h2 class="filter-tab active" data-tab="all">ALL</h2>
      <h2 class="filter-tab" data-tab="classic">CLASSIC</h2>
      <h2 class="filter-tab" data-tab="limited">LIMITED</h2>
      <h2 class="filter-tab" data-tab="3packs">3PACKS</h2>
    </div>

    <h2 class="color-label" id="colorLabel">
      @if(!empty($colorVariants))
        {{ $colorVariants[0]['color_name'] ?? $product->color_name ?? '' }}
      @else
        {{ $product->color_name ?? '' }}
      @endif
    </h2>

    <div class="swatches-row" id="swatchesRow">
      @if(!empty($colorVariants))
        @foreach($colorVariants as $i => $variant)
          @php
            $img1 = !empty($variant['image'])   ? asset('storage/'.$variant['image'])   : '';
            $img2 = !empty($variant['image_2']) ? asset('storage/'.$variant['image_2']) : '';
          @endphp
          <div class="swatch-outer {{ $i === 0 ? 'active' : '' }}"
               data-color-name="{{ $variant['color_name'] ?? '' }}"
               data-img1="{{ $img1 }}"
data-img2="{{ $img2 }}"
               title="{{ $variant['color_name'] ?? '' }}">
            <span class="swatch-inner" style="background-color: {{ $variant['color_hex'] ?? '#000' }};"></span>
          </div>
        @endforeach
      @elseif($product->color_hex)
        <div class="swatch-outer active"
             data-color-name="{{ $product->color_name ?? '' }}"
             data-img-1="{{ $product->image_url }}"
             data-img-2="{{ $product->image_2 ? asset('storage/'.$product->image_2) : $product->image_url }}">
          <span class="swatch-inner" style="background-color: {{ $product->color_hex }};"></span>
        </div>
      @endif
    </div>

    <div id="sizeGrid">
      @forelse($product->available_sizes as $size)
        <button class="size-btn" data-tab="all classic">{{ $size }}</button>
      @empty
        <h2 style="grid-column:span 4;font-size:0.85rem;color:#aaa;padding:0.5rem 0;">Sizes not available</h2>
      @endforelse
    </div>

    <h2 class="fit-note">
      Fits true to size. We suggest sizing up if you want something roomier.
      <button id="openFitGuide">Fit Guide</button>
    </h2>

    <button id="selectSizeBtn" disabled>SELECT A SIZE</button>

    <h2 class="shipping-note">Free Shipping on Orders over $75<br>Easy Returns</h2>
  </div>
</div>


<div class="accordion-wrap">

  <div class="accordion-item">
    <button class="accordion-btn" onclick="toggleAccordion(this)">
      <h2 style="font-family:Georgia,serif;font-size:1.4rem;font-weight:400;margin:0;letter-spacing:0.02em;">WHY WE MADE THIS</h2>
      <h2 class="accordion-icon">+</h2>
    </button>
    <div class="accordion-body">
      <div class="why-grid">

        <div class="why-left">
          <h2>{{ $product->description ?? 'The Anytime No Show Heel Grip sock is an evolution of our lowest profile sock silhouette. A new silicone grip hugs your heel to prevent the sock from sliding down into your shoe. This lightweight sock is designed to be comfortable but also stay out of sight. The go-to style when you want a lightweight feel and barefoot look.' }}</h2>
          <div>
            <h2 class="best-for-label">BEST FOR</h2>
            <div class="why-tags">
              <h2>Everyday</h2>
              <h2>Walking</h2>
              <h2>Workouts</h2>
              <h2>Commuting</h2>
              <h2>Light Jogging</h2>
            </div>
          </div>
          <div>
            <button class="tech-toggle" onclick="toggleTech(this)">
              <h2 class="tech-arrow">›</h2>
              <h2 class="tech-label">View technical details</h2>
            </button>
            <div class="tech-list" style="display:none;">
              <h2><strong>Weight:</strong> 10.9oz (M9) / 9.0oz (W7)</h2>
              <h2><strong>Heel/Toe Drop:</strong> 7mm</h2>
              <h2><strong>Stack Height:</strong> Heel: 22.9mm, Toe: 15.9mm</h2>
              <h2><strong>Country of Origin:</strong> Vietnam</h2>
            </div>
          </div>
        </div>

        <div class="why-circle-wrap" style="display:flex;justify-content:center;">
          <div class="why-circle">
            <img id="whyCircleImg" src="{{ $product->image_url }}" alt="{{ $product->name }}">
          </div>
        </div>

        <div class="why-right">
          <h2 class="why-section-label">THOUGHTFULLY DESIGNED</h2>
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
      <h2 style="font-family:Georgia,serif;font-size:1.4rem;font-weight:400;margin:0;letter-spacing:0.02em;">MATERIALS &amp; SUSTAINABILITY</h2>
      <h2 class="accordion-icon">+</h2>
    </button>
    <div class="accordion-body">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-4 text-sm text-gray-600 leading-relaxed">
        <h2><strong>Upper:</strong> Tree Knit – TENCEL® Lyocell and recycled polyester</h2>
        <h2><strong>Midsole:</strong> SweetFoam® – Sugarcane-based EVA foam</h2>
        <h2><strong>Outsole:</strong> Natural rubber – For durability and traction</h2>
        <h2><strong>Laces:</strong> 100% recycled polyester from plastic bottles</h2>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <button class="accordion-btn" onclick="toggleAccordion(this)">
      <h2 style="font-family:Georgia,serif;font-size:1.4rem;font-weight:400;margin:0;letter-spacing:0.02em;">CARE INSTRUCTIONS</h2>
      <h2 class="accordion-icon">+</h2>
    </button>
    <div class="accordion-body">
      <h2 class="text-sm text-gray-600 py-3 leading-relaxed">
        Yes, they're machine washable. Remove the insoles, hand wash those separately, and let everything air dry. Do not tumble dry or iron.
      </h2>
    </div>
  </div>

</div>

<style>
  /* FIT GUIDE MODAL */
  .fit-modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.45);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; visibility: hidden; transition: all 0.3s; z-index: 50;
  }
  .fit-modal-overlay.open { opacity: 1; visibility: visible; }
  .fit-modal-box {
    background: #fff; width: 95%; max-width: 780px; border-radius: 20px;
    padding: 2.5rem 2.5rem 2rem; position: relative;
    transform: scale(0.95); transition: transform 0.3s;
    max-height: 90vh; overflow-y: auto;
  }
  .fit-modal-overlay.open .fit-modal-box { transform: scale(1); }
  .fit-modal-close {
    position: absolute; top: 1.2rem; right: 1.5rem;
    background: none; border: none; font-size: 1.6rem; font-weight: 300;
    cursor: pointer; color: #555; line-height: 1;
  }
  .fit-modal-title {
    font-family: Georgia, serif; font-size: 1.6rem; font-weight: 400;
    text-align: center; color: #111; margin-bottom: 2rem;
  }

  /* SIZE TABLE */
  .fit-section-label {
    font-size: 0.72rem; font-weight: 800; letter-spacing: 0.12em;
    color: #111; margin-bottom: 0.75rem; font-family: 'Courier New', monospace;
  }
  .fit-table-wrap { margin-bottom: 2rem; }
  .fit-table {
    width: 100%; border-collapse: separate; border-spacing: 0;
    border-radius: 14px; overflow: hidden;
    border: 1px solid #e5e2dc;
  }
  .fit-table td, .fit-table th {
    padding: 0.9rem 1rem; font-size: 0.88rem; color: #333;
    text-align: center; border-bottom: 1px solid #e5e2dc;
  }
  .fit-table tr:last-child td { border-bottom: none; }
  /* Row label column */
  .fit-table td:first-child {
    background: #f0ede8; font-weight: 600; color: #111;
    text-align: center; border-right: 1px solid #e5e2dc;
    white-space: nowrap;
  }
  /* Highlighted middle column */
  .fit-table td.highlight, .fit-table th.highlight {
    background: #eae7e1;
  }
  /* Normal data cells */
  .fit-table td:not(:first-child) { background: #fff; }
  .fit-table td.highlight { background: #eae7e1 !important; }

  .fit-divider { border: none; border-top: 1px solid #e5e2dc; margin: 0.5rem 0 1.75rem; }
</style>

<div id="fitModal" class="fit-modal-overlay">
  <div class="fit-modal-box">
    <button id="closeFitGuide" class="fit-modal-close">&times;</button>
    <h1 class="fit-modal-title">{{ $product->name }}</h1>

    {{-- MEN'S SOCKS --}}
    <div class="fit-table-wrap">
      <h1 class="fit-section-label">MEN'S SOCKS</h1>
      <table class="fit-table">
        <tbody>
          <tr>
            <td>Socks</td>
            <td>M</td>
            <td class="highlight">L</td>
            <td>XL</td>
          </tr>
          <tr>
            <td>US Shoes</td>
            <td>8</td>
            <td class="highlight">9-12</td>
            <td>13-14</td>
          </tr>
          <tr>
            <td>UK Shoes</td>
            <td>7</td>
            <td class="highlight">8-11</td>
            <td>12-13</td>
          </tr>
          <tr>
            <td>cm</td>
            <td>25</td>
            <td class="highlight">26-29</td>
            <td>29.5-30.5</td>
          </tr>
        </tbody>
      </table>
    </div>

    <hr class="fit-divider">

    {{-- WOMEN'S SOCKS --}}
    <div class="fit-table-wrap">
      <h1 class="fit-section-label">WOMEN'S SOCKS</h1>
      <table class="fit-table">
        <tbody>
          <tr>
            <td>Socks</td>
            <td>S</td>
            <td class="highlight">M</td>
            <td>L</td>
          </tr>
          <tr>
            <td>US Shoes</td>
            <td>5-7</td>
            <td class="highlight">8-10</td>
            <td>11</td>
          </tr>
          <tr>
            <td>UK Shoes</td>
            <td>2 - 4.5</td>
            <td class="highlight">5-7.5</td>
            <td>8 - 8.5</td>
          </tr>
          <tr>
            <td>cm</td>
            <td>21.5-23.5</td>
            <td class="highlight">24-26</td>
            <td>26.5</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>


<section style="width:100%;margin:3rem 0 0;padding:0 2rem;">
  <div style="background:#7C8C52;border-radius:20px;padding:4rem 2rem;text-align:center;">
    <h2 style="color:#fff;font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.5rem;">The {{ $product->name }} Collection</h2>
    <h1 style="color:#fff;font-size:3rem;font-family:Georgia,serif;font-weight:400;margin:1rem 0 2rem;">Comfort That Keeps Up</h1>
    <a href="{{ url('/men/shoes') }}"
       style="display:inline-block;border:2px solid #fff;color:#fff;font-weight:700;padding:0.8rem 2.5rem;border-radius:999px;text-decoration:none;font-size:0.9rem;"
       onmouseover="this.style.background='#fff';this.style.color='#000'"
       onmouseout="this.style.background='transparent';this.style.color='#fff'">
      Shop Now
    </a>
  </div>
</section>


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

  /* Swatch click — updates both main image and second image slot */
  const swatchesRow = document.getElementById('swatchesRow');
  if (swatchesRow) {
    swatchesRow.addEventListener('click', function(e) {
      const outer = e.target.closest('.swatch-outer');
      if (!outer) return;
      swatchesRow.querySelectorAll('.swatch-outer').forEach(s => s.classList.remove('active'));
      outer.classList.add('active');

      const name = outer.dataset.colorName || '';
      const img1 = outer.dataset.img1 || '';
      const img2 = outer.dataset.img2 || '';

      document.getElementById('colorLabel').textContent = name;

      if (img1) {
        document.getElementById('mainImage').src = img1;
        const circleImg = document.getElementById('whyCircleImg');
        if (circleImg) {
          circleImg.style.opacity = '0';
          setTimeout(() => { circleImg.src = img1; circleImg.style.opacity = '1'; }, 220);
        }
      }

      /* FIX: replace entire slot so placeholder div never blocks the image */
      const slot = document.getElementById('secondImageSlot');
      if (slot) {
        const src = img2 || img1;
        slot.innerHTML = `<img id="secondImage" src="${src}" alt="${name}" style="width:100%;height:100%;min-height:480px;object-fit:contain;border-radius:16px;background:#dedad4;display:block;">`;
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
  if (selectBtn) {
  selectBtn.addEventListener('click', function() {
    if (!selectedSize) return;
    document.getElementById('formSize').value = selectedSize;
    document.getElementById('addToCartForm').submit();
  });
}
  /* Fit Guide Modal */
  const openBtn = document.getElementById('openFitGuide');
  const closeBtn = document.getElementById('closeFitGuide');
  const modal = document.getElementById('fitModal');
  if (openBtn && modal) {
    openBtn.addEventListener('click', () => modal.classList.add('open'));
    closeBtn.addEventListener('click', () => modal.classList.remove('open'));
    modal.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('open'); });
  }

  /* Swiper */
  if (typeof Swiper !== 'undefined') {
    new Swiper('.mySwiper', {
      slidesPerView: 4, spaceBetween: 24, loop: true, speed: 800, grabCursor: true,
      navigation: { nextEl: '.custom-next', prevEl: '.custom-prev' },
      breakpoints: { 0: { slidesPerView: 1 }, 640: { slidesPerView: 2 }, 1024: { slidesPerView: 4 } },
    });
  }

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

});</script>

</x-layouts>