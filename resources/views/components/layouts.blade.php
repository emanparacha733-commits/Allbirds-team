<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Allbirds | Sustainable Shoes & Apparel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Source+Serif+4:ital,wght@1,600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    body { font-family: 'Inter', sans-serif; }
    .font-allbirds-logo { font-family: 'Source Serif 4', serif; font-style: italic; }

    nav { position: relative; }

    .nav-item {
        height: 100%;
        display: flex;
        align-items: center;
        position: static;
    }

    .nav-item > a {
        height: 100%;
        display: flex;
        align-items: center;
        padding: 0 14px;
        border-bottom: 2px solid transparent;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        transition: border-color 0.15s;
        white-space: nowrap;
    }

    .nav-item:hover > a { border-bottom-color: black; }
    .nav-item.sale-item:hover > a { border-bottom-color: #dc2626; }

    .mega-menu {
        display: none;
        position: fixed;
        top: 112px;
        left: 0;
        right: 0;
        width: 100vw;
        background: #f0ede8;
        box-shadow: 0 10px 30px rgba(0,0,0,0.10);
        z-index: 100;
    }

    .nav-item:hover .mega-menu { display: block; }

    .sub-tab-bar {
        background: #e4e0d8;
        padding: 10px 0;
        display: flex;
        justify-content: center;
        gap: 32px;
    }

    .sub-tab {
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        padding-bottom: 3px;
        border-bottom: 1.5px solid transparent;
        color: #6b7280;
        background: none;
        border-top: none;
        border-left: none;
        border-right: none;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: color 0.15s, border-color 0.15s;
    }

    .sub-tab:hover, .sub-tab.active { color: black; border-bottom-color: black; }
    .sub-tab.sale-tab:hover, .sub-tab.sale-tab.active { color: #dc2626; border-bottom-color: #dc2626; }

    .sub-panel { display: none; }
    .sub-panel.active { display: block; }

    .panel-inner {
        max-width: 1300px;
        margin: 0 auto;
        padding: 40px 48px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        min-height: 380px;
    }

    .mega-menu-image {
        display: block;
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        transition: opacity 0.3s ease;
    }

    .mega-menu-image:hover { opacity: 0.9; }
    .mega-menu-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
    .mega-menu-image:hover img { transform: scale(1.08); }

    /* ── Cart Sidebar ── */
    .cart-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 9998;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .cart-overlay.active { display: block; opacity: 1; }

    .cart-sidebar {
        position: fixed;
        top: 0;
        right: -550px;
        width: 500px;
        max-width: 100vw;
        height: 100vh;
        background: white;
        z-index: 9999;
        box-shadow: -2px 0 10px rgba(0,0,0,0.1);
        transition: right 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .cart-sidebar.active { right: 0; }

    .cart-progress { padding: 12px 24px; background: #212121; color: white; font-size: 13px; text-align: center; font-weight: 500; }
    .cart-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid #e5e5e5; }
    .cart-title { font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin: 0; }
    .cart-close { background: none; border: none; font-size: 32px; cursor: pointer; color: #666; line-height: 1; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; }
    .cart-close:hover { color: black; }
    .cart-body { flex: 1; overflow-y: auto; display: flex; flex-direction: column; }
    .cart-items { flex: 1; padding: 0; }

    .cart-item { display: flex; gap: 16px; padding: 24px; border-bottom: 1px solid #e5e5e5; }
    .cart-item-image { width: 80px; height: 80px; flex-shrink: 0; }
    .cart-item-image img { width: 100%; height: 100%; object-fit: cover; border-radius: 4px; }
    .cart-item-details { flex: 1; }
    .cart-item-name { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 6px 0; }
    .cart-item-variant, .cart-item-size { font-size: 12px; color: #666; margin: 4px 0; }
    .cart-item-remove { background: none; border: none; color: #666; font-size: 12px; text-decoration: underline; cursor: pointer; padding: 0; margin-top: 8px; }
    .cart-item-remove:hover { color: black; }
    .cart-item-right { display: flex; flex-direction: column; align-items: flex-end; gap: 12px; }
    .cart-item-price { font-size: 16px; font-weight: 600; margin: 0; }

    .cart-item-quantity { display: flex; align-items: center; gap: 4px; border: 1px solid #e5e5e5; border-radius: 4px; padding: 2px; }
    .qty-btn { background: white; border: none; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #666; transition: background 0.2s; }
    .qty-btn:hover { background: #f5f5f5; color: black; }
    .qty-input { width: 40px; text-align: center; border: none; font-size: 14px; font-weight: 600; }

    .cart-upsell { display: flex; justify-content: space-between; align-items: center; gap: 16px; padding: 20px 24px; background: #f9f9f9; border-bottom: 1px solid #e5e5e5; }
    .cart-upsell-content h4 { font-size: 13px; font-weight: 700; margin: 0 0 4px 0; }
    .cart-upsell-content p { font-size: 12px; color: #666; margin: 0; line-height: 1.4; }
    .cart-upsell-btn { background: black; color: white; border: none; padding: 10px 20px; border-radius: 4px; font-size: 12px; font-weight: 700; cursor: pointer; white-space: nowrap; }
    .cart-upsell-btn:hover { background: #333; }

    .cart-footer { border-top: 1px solid #e5e5e5; padding: 24px; background: white; }
    .cart-totals { margin-bottom: 20px; }
    .cart-total-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; font-size: 14px; }
    .cart-total-price { font-weight: 600; }
    .cart-shipping-price { color: #666; }
    .cart-shipping-price s { margin-right: 8px; }

    .cart-checkout-btn { width: 100%; background: #5a5a5a; color: white; border: none; padding: 18px; border-radius: 4px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: background 0.2s; margin-bottom: 16px; display: block; text-align: center; text-decoration: none; }
    .cart-checkout-btn:hover { background: #212121; }

    .cart-payment-options { display: flex; gap: 8px; }
    .payment-option-btn { flex: 1; border: 1px solid #e5e5e5; border-radius: 4px; padding: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 11px; transition: transform 0.2s; }
    .payment-option-btn:hover { transform: translateY(-2px); }

    @media (max-width: 640px) {
        .cart-sidebar { width: 100vw; right: -100vw; }
    }
    </style>
</head>

<body class="antialiased bg-whiteoverflow-x-hidden"></body">

<header class="w-full">
    <!-- Announcement bar -->
    <div class="bg-black text-white text-[11px] py-2.5 text-center font-bold tracking-tight sticky top-0 left-0 right-0 z-50">
        <span>Shop New Arrivals. </span>
        <a href="/men" class="underline hover:no-underline">Shop Men</a>
        <span class="mx-1">|</span>
        <a href="/women" class="underline hover:no-underline">Shop Women</a>
    </div>

    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-[1400px] mx-auto px-6 h-16 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex-1">
                <a href="/">
                    <img src="{{ asset('images/logo-seo.jpeg') }}" alt="allbirds" class="h-20 w-auto">
                </a>
            </div>

            <!-- Nav items -->
            <div class="flex items-center h-full relative" id="nav-wrapper">

                <!-- MEN -->
                <div class="nav-item" id="nav-men">
                    <a href="{{ route('men.index') }}">Men</a>
                    <div class="mega-menu">
                        <div class="sub-tab-bar">
                            <button class="sub-tab active" onmouseenter="switchPanel('men','shoes',this)">Shoes</button>
                            <button class="sub-tab" onmouseenter="switchPanel('men','apparel',this)">Socks & Apparel</button>
                            <button class="sub-tab sale-tab" onmouseenter="switchPanel('men','sale',this)">Sale</button>
                        </div>
                        <div class="sub-panel active" id="men-shoes">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('men.collection', 'dasher-nz') }}" class="hover:underline">Dasher NZ Collection</a></li>
                                        <li><a href="{{ route('men.collection', 'terralux') }}" class="hover:underline">Terralux™ Collection</a></li>
                                        <li><a href="{{ route('men.collection', 'varsity') }}" class="hover:underline">Varsity Collection</a></li>
                                        <li><a href="{{ route('men.collection', 'new-arrivals') }}" class="hover:underline">New Arrivals</a></li>
                                        <li><a href="{{ route('men.collection', 'bestsellers') }}" class="hover:underline">Bestsellers</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Men's Shoes</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('men.shoes') }}" class="hover:underline italic">Shop All</a></li>
                                            <li><a href="{{ route('men.shoes.category', 'sneakers') }}" class="hover:underline">Sneakers</a></li>
                                            <li><a href="{{ route('men.shoes.category', 'slip-ons') }}" class="hover:underline">Slip Ons</a></li>
                                            <li><a href="{{ route('men.shoes.category', 'slippers') }}" class="hover:underline">Slippers</a></li>
                                            <li><a href="{{ route('men.shoes.category', 'all-weather') }}" class="hover:underline">All-Weather</a></li>
                                            <li><a href="{{ route('men.shoes.category', 'sandals') }}" class="hover:underline">Sandals</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customer Favorites</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('men.product', 'tree-runner-nz') }}" class="hover:underline">Tree Runner NZ</a></li>
                                            <li><a href="{{ route('men.product', 'tree-runner') }}" class="hover:underline">The Original Tree Runner</a></li>
                                            <li><a href="{{ route('men.product', 'varsity') }}" class="hover:underline">Varsity</a></li>
                                            <li><a href="{{ route('men.product', 'dasher-nz') }}" class="hover:underline">Dasher NZ</a></li>
                                            <li><a href="{{ route('men.product', 'wool-cruiser') }}" class="hover:underline">Wool Cruiser</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Top Add-Ons</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('men.apparel', 'socks') }}" class="hover:underline">Socks</a></li>
                                            <li><a href="{{ route('men.apparel') }}" class="hover:underline">Apparel</a></li>
                                            <li><a href="{{ route('accessories', 'bags') }}" class="hover:underline">Bags</a></li>
                                            <li><a href="{{ route('gift-cards') }}" class="hover:underline">Gift Cards</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('men.collection', 'dasher-nz') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img1.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px]">Dasher NZ Collection</span>
                                    </a>
                                    <div class="flex flex-col gap-3">
                                        <a href="{{ route('men.collection', 'varsity') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img2.webp') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Varsity Collection</span>
                                        </a>
                                        <a href="{{ route('men.new-arrivals') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img3.jpg') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Men's New Arrivals</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sub-panel" id="men-apparel">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('men.apparel.collection', 'new-arrivals') }}" class="hover:underline">New Arrivals</a></li>
                                        <li><a href="{{ route('men.apparel.collection', 'bestsellers') }}" class="hover:underline">Bestsellers</a></li>
                                        <li><a href="{{ route('men.apparel.collection', 'tree-apparel') }}" class="hover:underline">Tree Apparel</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Socks</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('men.socks.category', 'no-show') }}" class="hover:underline">No Show</a></li>
                                            <li><a href="{{ route('men.socks.category', 'ankle') }}" class="hover:underline">Ankle</a></li>
                                            <li><a href="{{ route('men.socks.category', 'crew') }}" class="hover:underline">Crew</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Men's Apparel</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('men.apparel.category', 'tees') }}" class="hover:underline">Tees</a></li>
                                            <li><a href="{{ route('men.apparel.category', 'sweats') }}" class="hover:underline">Sweats</a></li>
                                            <li><a href="{{ route('men.apparel') }}" class="hover:underline">All Apparel</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('men.apparel.new') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img4.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px]">New in Apparel</span>
                                    </a>
                                    <div class="flex flex-col gap-3">
                                        <a href="{{ route('men.socks') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img5.webp') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Socks</span>
                                        </a>
                                        <a href="{{ route('accessories') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img2.webp') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Accessories</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sub-panel" id="men-sale">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('sale.men', ['discount' => '50']) }}" class="hover:underline text-red-600">Up to 50% Off</a></li>
                                        <li><a href="{{ route('sale.men.clearance') }}" class="hover:underline">Clearance</a></li>
                                        <li><a href="{{ route('sale.men.last-chance') }}" class="hover:underline">Last Chance</a></li>
                                    </ul>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.men') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img5.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Up to 50% Off</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- WOMEN -->
                <div class="nav-item" id="nav-women">
                    <a href="{{ route('women.index') }}">Women</a>
                    <div class="mega-menu">
                        <div class="sub-tab-bar">
                            <button class="sub-tab active" onmouseenter="switchPanel('women','shoes',this)">Shoes</button>
                            <button class="sub-tab" onmouseenter="switchPanel('women','apparel',this)">Socks & Apparel</button>
                            <button class="sub-tab sale-tab" onmouseenter="switchPanel('women','sale',this)">Sale</button>
                        </div>
                        <div class="sub-panel active" id="women-shoes">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('women.collection', 'dasher-nz') }}" class="hover:underline">Dasher NZ Collection</a></li>
                                        <li><a href="{{ route('women.collection', 'varsity') }}" class="hover:underline">Varsity Collection</a></li>
                                        <li><a href="{{ route('women.collection', 'new-arrivals') }}" class="hover:underline">New Arrivals</a></li>
                                        <li><a href="{{ route('women.collection', 'bestsellers') }}" class="hover:underline">Bestsellers</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Women's Shoes</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('women.shoes') }}" class="hover:underline italic">Shop All</a></li>
                                            <li><a href="{{ route('women.shoes.category', 'sneakers') }}" class="hover:underline">Sneakers</a></li>
                                            <li><a href="{{ route('women.shoes.category', 'slip-ons') }}" class="hover:underline">Slip Ons</a></li>
                                            <li><a href="{{ route('women.shoes.category', 'flats') }}" class="hover:underline">Flats</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('women.collection', 'dasher-nz') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img6.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px]">Dasher NZ Collection</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="sub-panel" id="women-apparel">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="#" class="hover:underline">New Arrivals</a></li>
                                        <li><a href="#" class="hover:underline">Bestsellers</a></li>
                                    </ul>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('women.apparel.new') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img9.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px]">New in Apparel</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="sub-panel" id="women-sale">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="#" class="hover:underline text-red-600">Up to 50% Off</a></li>
                                    </ul>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.women') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img10.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Up to 50% Off</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SALE -->
                <div class="nav-item sale-item" id="nav-sale">
                    <a href="{{ route('sale.index') }}" style="color:#dc2626;">Sale</a>
                    <div class="mega-menu">
                        <div class="sub-tab-bar">
                            <button class="sub-tab sale-tab active" onmouseenter="switchPanel('sale','featured',this)">Featured Deals</button>
                            <button class="sub-tab" onmouseenter="switchPanel('sale','shoes',this)">Shoes</button>
                            <button class="sub-tab" onmouseenter="switchPanel('sale','apparel',this)">Apparel</button>
                        </div>
                        <div class="sub-panel active" id="sale-featured">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="#" class="hover:underline text-red-600">Up to 50% Off</a></li>
                                        <li><a href="#" class="hover:underline">Clearance</a></li>
                                    </ul>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.index') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img10.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Up to 50% Off</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="sub-panel" id="sale-shoes">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="#" class="hover:underline text-red-600">Men's Sale Shoes</a></li>
                                        <li><a href="#" class="hover:underline text-red-600">Women's Sale Shoes</a></li>
                                    </ul>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.shoes') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img5.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Sale Shoes</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="sub-panel" id="sale-apparel">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="#" class="hover:underline text-red-600">Men's Sale Apparel</a></li>
                                        <li><a href="#" class="hover:underline text-red-600">Women's Sale Apparel</a></li>
                                    </ul>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.category', 'apparel') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img9.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Sale Apparel</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right icons -->
            <div class="flex-1 flex items-center justify-end space-x-5 text-gray-800">
                <a href="#" class="text-[12px] font-bold hover:underline">About</a>
                <a href="#" class="text-[12px] font-bold hover:underline">ReRun</a>
                <a href="#"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></a>
                <a href="#"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path></svg></a>
                <a href="#"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path></svg></a>

                {{-- Cart Icon with live count from session --}}
                @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                <button onclick="openCart()" class="relative bg-transparent border-0 cursor-pointer p-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z"></path>
                    </svg>
                    @if($cartCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-black text-white text-[9px] w-4 h-4 flex items-center justify-center rounded-full font-bold">{{ $cartCount }}</span>
                    @endif
                </button>
            </div>
        </div>
    </nav>
</header>

<main>
    {{ $slot }}
</main>

<!-- Cart Overlay -->
<div class="cart-overlay" id="cartOverlay"></div>

<!-- =====================================================
     CART SIDEBAR — reads 100% from Laravel session
====================================================== -->
@php
    $sidebarCart = session('cart', []);
    $sidebarSubtotal = 0;
    foreach ($sidebarCart as $item) {
        $sidebarSubtotal += $item['price'] * $item['quantity'];
    }
    $freeShippingThreshold = 75;
    $remaining = max(0, $freeShippingThreshold - $sidebarSubtotal);
@endphp

<div class="cart-sidebar" id="cartSidebar">

    {{-- Progress Bar --}}
    <div class="cart-progress">
        @if($remaining > 0)
            Spend <strong>${{ number_format($remaining, 2) }}</strong> more for free shipping!
        @else
            🎉 You've earned free shipping!
        @endif
    </div>

    {{-- Header --}}
    <div class="cart-header">
        <h2 class="cart-title">CART ({{ array_sum(array_column($sidebarCart, 'quantity')) }})</h2>
        <button class="cart-close" id="cartClose">&times;</button>
    </div>

    {{-- Body --}}
    <div class="cart-body">
        <div class="cart-items">

            @forelse($sidebarCart as $itemId => $item)
            <div class="cart-item">

                {{-- Image --}}
                <div class="cart-item-image">
                    <img src="{{ asset($item['image']) }}"
                         alt="{{ $item['name'] }}"
                         onerror="this.src='https://via.placeholder.com/80x80?text=Product'">
                </div>

                {{-- Details --}}
                <div class="cart-item-details">
                    <h3 class="cart-item-name">{{ strtoupper($item['name']) }}</h3>
                    @if(!empty($item['color']))
                        <p class="cart-item-variant">{{ $item['color'] }}</p>
                    @endif
                    <p class="cart-item-size">Size: {{ $item['size'] }}</p>
                    <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $itemId }}">
                        <button type="submit" class="cart-item-remove">Remove</button>
                    </form>
                </div>

                {{-- Price + Qty --}}
                <div class="cart-item-right">
                    <p class="cart-item-price">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    <div class="cart-item-quantity">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $itemId }}">
                            <input type="hidden" name="quantity" value="{{ max(0, $item['quantity'] - 1) }}">
                            <button type="submit" class="qty-btn">−</button>
                        </form>
                        <span class="qty-input">{{ $item['quantity'] }}</span>
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $itemId }}">
                            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                            <button type="submit" class="qty-btn">+</button>
                        </form>
                    </div>
                </div>

            </div>
            @empty
            <div class="p-8 text-center text-gray-500">
                <p class="text-lg mb-4">Your cart is empty</p>
                <a href="{{ route('men.shoes') }}" class="text-black underline text-sm">Start Shopping</a>
            </div>
            @endforelse

            {{-- Returns Protection Upsell --}}
            @if(!empty($sidebarCart))
            <div class="cart-upsell">
                <div class="cart-upsell-content">
                    <h4>Returns Protection</h4>
                    <p>Buy returns protection to qualify for free returns. Does not apply to Final Sale items.</p>
                </div>
                <button class="cart-upsell-btn">ADD - $3</button>
            </div>
            @endif

        </div>
    </div>

    {{-- Footer --}}
    @if(!empty($sidebarCart))
    <div class="cart-footer">
        <div class="cart-totals">
            <div class="cart-total-row">
                <span>Subtotal</span>
                <span class="cart-total-price">${{ number_format($sidebarSubtotal, 2) }}</span>
            </div>
            <div class="cart-total-row">
                <span>Shipping</span>
                @if($sidebarSubtotal >= $freeShippingThreshold)
                    <span class="cart-shipping-price"><s>$5.00</s> FREE</span>
                @else
                    <span class="cart-shipping-price">$5.00</span>
                @endif
            </div>
        </div>

        <a href="{{ route('checkout') }}" class="cart-checkout-btn">
            CHECKOUT — ${{ number_format($sidebarSubtotal, 2) }}
        </a>

        <div class="cart-payment-options">
            <button class="payment-option-btn" style="background:#ffc439; color:black;">amazon pay</button>
            <button class="payment-option-btn" style="background:#0070ba; color:white;">PayPal</button>
            <button class="payment-option-btn" style="background:#5a31f4; color:white;">Shop Pay</button>
        </div>
    </div>
    @endif

</div>
{{-- ===== END CART SIDEBAR ===== --}}

{{-- Auto-open cart after adding item --}}
@if(session('open_cart'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        openCart();
    });
</script>
@endif

<script>
    AOS.init({ duration: 800, once: true });

    /* ── Mega Menu ── */
    function switchPanel(menu, panel, hoveredBtn) {
        const navItem = document.getElementById('nav-' + menu);
        navItem.querySelectorAll('.sub-panel').forEach(p => p.classList.remove('active'));
        navItem.querySelectorAll('.sub-tab').forEach(t => t.classList.remove('active'));
        const target = document.getElementById(menu + '-' + panel);
        if (target) target.classList.add('active');
        hoveredBtn.classList.add('active');
    }

    document.querySelectorAll('.nav-item').forEach(navItem => {
        let leaveTimer;
        const hideMenu = () => {
            const megaMenu = navItem.querySelector('.mega-menu');
            if (megaMenu) megaMenu.style.display = 'none';
            navItem.querySelectorAll('.sub-panel').forEach(p => p.classList.remove('active'));
            navItem.querySelectorAll('.sub-tab').forEach(t => t.classList.remove('active'));
            const firstPanel = navItem.querySelector('.sub-panel');
            const firstTab   = navItem.querySelector('.sub-tab');
            if (firstPanel) firstPanel.classList.add('active');
            if (firstTab)   firstTab.classList.add('active');
        };
        const showMenu = () => {
            clearTimeout(leaveTimer);
            const megaMenu = navItem.querySelector('.mega-menu');
            if (megaMenu) megaMenu.style.display = 'block';
        };
        const delayHide = () => { leaveTimer = setTimeout(hideMenu, 100); };
        navItem.addEventListener('mouseenter', showMenu);
        navItem.addEventListener('mouseleave', delayHide);
        const megaMenu = navItem.querySelector('.mega-menu');
        if (megaMenu) {
            megaMenu.addEventListener('mouseenter', showMenu);
            megaMenu.addEventListener('mouseleave', delayHide);
        }
    });

    /* ── Cart ── */
    function openCart() {
        document.getElementById('cartOverlay').classList.add('active');
        document.getElementById('cartSidebar').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeCart() {
        document.getElementById('cartOverlay').classList.remove('active');
        document.getElementById('cartSidebar').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.getElementById('cartOverlay').addEventListener('click', closeCart);
    document.getElementById('cartClose').addEventListener('click', closeCart);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCart(); });
</script>

<footer class="bg-[#0f0f0f] text-gray-300 text-sm">
    <div class="max-w-7xl mx-auto px-6 pt-16 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-10 md:gap-6 lg:gap-8 mb-16">
            <div class="md:col-span-2">
                <form class="flex flex-col sm:flex-row gap-3 max-w-md">
                    <h2>Subscribe to our emails</h2>
                    <input type="email" placeholder="Email Address"
                           class="flex-1 bg-transparent border border-gray-600 rounded-full px-6 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-gray-400 transition">
                    <button type="submit" class="bg-white text-black font-medium px-8 py-3 rounded-full hover:bg-gray-200 transition whitespace-nowrap">SIGN UP</button>
                </form>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:col-span-3 gap-x-8 gap-y-10 text-gray-400">
                <div><ul class="space-y-3">
                    <li><a href="#" class="hover:text-white transition">Live Chat</a></li>
                    <li><a href="#" class="hover:text-white transition">Call Us</a></li>
                    <li><a href="#" class="hover:text-white transition">FAQ/Contact Us</a></li>
                </ul></div>
                <div><ul class="space-y-3">
                    <li><a href="#" class="hover:text-white transition">Men's Shoes</a></li>
                    <li><a href="#" class="hover:text-white transition">Women's Shoes</a></li>
                    <li><a href="#" class="hover:text-white transition">Returns/Exchanges</a></li>
                    <li><a href="#" class="hover:text-white transition">Gift Cards</a></li>
                </ul></div>
                <div><ul class="space-y-3">
                    <li><a href="#" class="hover:text-white transition">Our Story</a></li>
                    <li><a href="#" class="hover:text-white transition">Sustainability</a></li>
                    <li><a href="#" class="hover:text-white transition">Our Blog</a></li>
                </ul></div>
            </div>
        </div>
        <div class="border-t border-gray-800 pt-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 text-xs text-gray-500 pt-6">
                <p>© 2025 Allbirds, Inc. All Rights Reserved</p>
                <div class="flex flex-wrap gap-x-6 gap-y-2">
                    <a href="#" class="hover:text-gray-300 transition">Privacy policy</a>
                    <a href="#" class="hover:text-gray-300 transition">Terms of service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>