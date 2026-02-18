<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Allbirds | Sustainable Shoes & Apparel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Source+Serif+4:ital,wght@1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
    <style>
    body { font-family: 'Inter', sans-serif; }
    .font-allbirds-logo { font-family: 'Source Serif 4', serif; font-style: italic; }

    /* ── Nav ── */
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

    .nav-item:hover > a {
        border-bottom-color: black;
    }

    .nav-item.sale-item:hover > a {
        border-bottom-color: #dc2626;
    }

    /* ── Mega menu: full width, beige background ── */
   .mega-menu {
    display: none;
    position: fixed;
    top: 112px;
    left: 0;
    right: 0;
    width: 100vw;
    background: #f1eee9;
    box-shadow: 0 10px 30px rgba(0,0,0,0.10);
    z-index: 100;
}

    .nav-item:hover .mega-menu {
        display: block;
    }

    /* ── Sub-tab bar: slightly darker beige strip ── */
   .sub-tab-bar {
    background: #e4e0d8;
    padding: 10px 0;
    display: flex;
    justify-content: center;
    gap: 32px;
    margin: 12px 16px;
    border-radius: 999px;
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
    
    .sub-tab:hover,
    .sub-tab.active {
        color: black;
        border-bottom-color: black;
    }
    
    .sub-tab.sale-tab:hover,
    .sub-tab.sale-tab.active {
        color: #dc2626;
        border-bottom-color: #dc2626;
    }

    /* ── Sub panels ── */
    .sub-panel { 
        display: none;
    }
    
    .sub-panel.active { 
        display: block; 
    }

    /* ── Panel inner layout ── */
    .panel-inner {
        max-width: 1300px;
        margin: 0 auto;
        padding: 40px 48px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        min-height: 380px;
    }

    /* ── Image zoom animation ── */
    .mega-menu-image {
        display: block;
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        transition: opacity 0.3s ease;
    }

    .mega-menu-image:hover {
        opacity: 0.9;
    }

    .mega-menu-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .mega-menu-image:hover img {
        transform: scale(1.08);
    }

    /* ── Shopping Cart Sidebar ── */
    .cart-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9998;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .cart-overlay.active {
        display: block;
        opacity: 1;
    }

    .cart-sidebar {
        position: fixed;
        top: 0;
        right: -550px;
        width: 500px;
        max-width: 100vw;
        height: 100vh;
        background: white;
        z-index: 9999;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        transition: right 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .cart-sidebar.active {
        right: 0;
    }

    /* Progress Bar */
    .cart-progress {
        padding: 12px 24px;
        background: #212121;
        color: white;
        font-size: 13px;
        text-align: center;
        font-weight: 500;
    }

    /* Cart Header */
    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid #e5e5e5;
    }

    .cart-title {
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin: 0;
    }

    .cart-close {
        background: none;
        border: none;
        font-size: 32px;
        cursor: pointer;
        color: #666;
        line-height: 1;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-close:hover {
        color: black;
    }

    /* Cart Body */
    .cart-body {
        flex: 1;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }

    .cart-items {
        flex: 1;
        padding: 0;
    }

    /* Cart Item */
    .cart-item {
        display: flex;
        gap: 16px;
        padding: 24px;
        border-bottom: 1px solid #e5e5e5;
    }

    .cart-item-image {
        width: 80px;
        height: 80px;
        flex-shrink: 0;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-name {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0 0 6px 0;
    }

    .cart-item-variant,
    .cart-item-size {
        font-size: 12px;
        color: #666;
        margin: 4px 0;
    }

    .cart-item-remove {
        background: none;
        border: none;
        color: #666;
        font-size: 12px;
        text-decoration: underline;
        cursor: pointer;
        padding: 0;
        margin-top: 8px;
    }

    .cart-item-remove:hover {
        color: black;
    }

    .cart-item-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
    }

    .cart-item-price {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
    }

    /* Quantity Controls */
    .cart-item-quantity {
        display: flex;
        align-items: center;
        gap: 4px;
        border: 1px solid #e5e5e5;
        border-radius: 4px;
        padding: 2px;
    }

    .qty-btn {
        background: white;
        border: none;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #666;
        transition: background 0.2s;
    }

    .qty-btn:hover {
        background: #f5f5f5;
        color: black;
    }

    .qty-input {
        width: 40px;
        text-align: center;
        border: none;
        font-size: 14px;
        font-weight: 600;
    }

    /* Upsell */
    .cart-upsell {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 20px 24px;
        background: #f9f9f9;
        border-bottom: 1px solid #e5e5e5;
    }

    .cart-upsell-content h4 {
        font-size: 13px;
        font-weight: 700;
        margin: 0 0 4px 0;
    }

    .cart-upsell-content p {
        font-size: 12px;
        color: #666;
        margin: 0;
        line-height: 1.4;
    }

    .cart-upsell-btn {
        background: black;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
        transition: background 0.2s;
    }

    .cart-upsell-btn:hover {
        background: #333;
    }

    /* Recommended */
    .cart-recommended {
        border-bottom: 1px solid #e5e5e5;
    }

    .cart-recommended-toggle {
        width: 100%;
        background: white;
        border: none;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.1em;
    }

    .cart-recommended-toggle:hover {
        background: #f9f9f9;
    }

    /* Cart Footer */
    .cart-footer {
        border-top: 1px solid #e5e5e5;
        padding: 24px;
        background: white;
    }

    .cart-totals {
        margin-bottom: 20px;
    }

    .cart-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .cart-total-row:last-child {
        margin-bottom: 0;
    }

    .cart-total-price {
        font-weight: 600;
    }

    .cart-shipping-price {
        color: #666;
    }

    .cart-shipping-price s {
        margin-right: 8px;
    }

    .cart-checkout-btn {
        width: 100%;
        background: #5a5a5a;
        color: white;
        border: none;
        padding: 18px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        cursor: pointer;
        transition: background 0.2s;
        margin-bottom: 16px;
    }

    .cart-checkout-btn:hover {
        background: #212121;
    }

    /* Payment Options */
    .cart-payment-options {
        display: flex;
        gap: 8px;
    }

    .payment-option-btn {
        flex: 1;
        background: #ffc439;
        border: 1px solid #e5e5e5;
        border-radius: 4px;
        padding: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s;
    }

    .payment-option-btn:hover {
        transform: translateY(-2px);
    }

    .payment-option-btn.paypal {
        background: #0070ba;
    }

    .payment-option-btn.shop-pay {
        background: #5a31f4;
    }
    #main-header {
    transition: background 0.2s ease;
}@media (max-width: 640px) {
        .cart-sidebar {
            width: 100vw;
            right: -100vw;
        }
    }

    /* ── Global #ECE9E2 theme overrides ── */
    body { background-color: #ECE9E2 !important; }
    .mega-menu { background: #ECE9E2 !important; }
    .sub-tab-bar { background: rgba(0,0,0,0.06) !important; }
    .cart-sidebar { background: #ECE9E2 !important; }
    .cart-footer { background: #ECE9E2 !important; }
    .cart-upsell { background: rgba(0,0,0,0.04) !important; }
    .cart-recommended-toggle { background: #ECE9E2 !important; }
    .cart-recommended-toggle:hover { background: rgba(0,0,0,0.04) !important; }
    .qty-btn { background: #ECE9E2 !important; }
    .qty-btn:hover { background: rgba(0,0,0,0.08) !important; }

    /* ── Cart #ECE9E2 fix ── */
    .cart-sidebar,
    .cart-sidebar .cart-footer,
    .cart-sidebar .cart-header,
    .cart-sidebar .cart-body,
    .cart-sidebar .cart-items,
    .cart-sidebar .cart-item,
    .cart-sidebar .cart-upsell,
    .cart-sidebar .cart-recommended-toggle,
    .cart-sidebar .cart-progress {
        background-color: #ECE9E2 !important;
        background: #ECE9E2 !important;
    }



#main-header:has(.nav-item:hover) {
    background: #f1eee9;
}

    /* Mobile Responsive */
    @media (max-width: 640px) {
        .cart-sidebar {
            width: 100vw;
            right: -100vw;
        }

    }
</style>
</head>

<body class="antialiased bg-white">

<header class="w-full" id="main-header">
    <!-- Announcement bar -->
    <div class="bg-black text-white text-[11px] py-2.5 text-center font-bold tracking-tight sticky top-0 left-0 right-0 z-50">
        <span>Shop New Arrivals. </span>
        <a href="/men" class="underline hover:no-underline">Shop Men</a>
        <span class="mx-1">|</span>
        <a href="/women" class="underline hover:no-underline">Shop Women</a>
    </div>

    <nav class="bg-white border border-gray-100 mx-4 mt-2 rounded-2xl shadow-sm">
    <div class="max-w-[1400px] mx-auto px-6 h-16 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex-1">
                <a href="/">
                    <img src="{{ asset('images/logo-seo.jpeg') }}" alt="allbirds" class="h-15 w-auto">
                </a>
            </div>

            <!-- Nav items -->
            <div class="flex items-center h-full relative" id="nav-wrapper">

                <!-- ── MEN ── -->
                <div class="nav-item" id="nav-men">
                    <a href="{{ route('men.index') }}">Men</a>

                    <div class="mega-menu">
                        <div class="sub-tab-bar">
                            <button class="sub-tab active" onmouseenter="switchPanel('men','shoes',this)">Shoes</button>
                            <button class="sub-tab" onmouseenter="switchPanel('men','apparel',this)">Socks & Apparel</button>
                            <button class="sub-tab sale-tab" onmouseenter="switchPanel('men','sale',this)">Sale</button>
                        </div>

                        <!-- Men Shoes -->
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

                        <!-- Men Apparel -->
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
                                            <li><a href="{{ route('men.socks') }}" class="hover:underline italic">All Socks</a></li>
                                            <li><a href="{{ route('men.socks.category', 'no-show') }}" class="hover:underline">No Show</a></li>
                                            <li><a href="{{ route('men.socks.category', 'ankle') }}" class="hover:underline">Ankle</a></li>
                                            <li><a href="{{ route('men.socks.category', 'crew') }}" class="hover:underline">Crew</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Men's Apparel</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('men.apparel') }}" class="hover:underline italic">All Apparel</a></li>
                                            <li><a href="{{ route('men.apparel.category', 'tees') }}" class="hover:underline">Tees</a></li>
                                            <li><a href="{{ route('men.apparel.category', 'sweats') }}" class="hover:underline">Sweats</a></li>
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

                        <!-- Men Sale -->
                        <div class="sub-panel" id="men-sale">
                            <div class="panel-inner">
                                
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sale Shoes</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.men.shoes') }}" class="hover:underline italic">Shop All Sale Shoes</a></li>
                                            <li><a href="{{ route('sale.men.shoes.category', 'sneakers') }}" class="hover:underline">Sneakers</a></li>
                                            <li><a href="{{ route('sale.men.shoes.category', 'running') }}" class="hover:underline">Running Shoes</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sale Apparel</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.men.apparel') }}" class="hover:underline italic">Shop All Sale Apparel</a></li>
                                            <li><a href="{{ route('sale.men.apparel.category', 'tees') }}" class="hover:underline">Tees</a></li>
                                            <li><a href="{{ route('sale.men.apparel.category', 'sweats') }}" class="hover:underline">Sweats</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sale Socks</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.men.socks') }}" class="hover:underline italic">Shop All Sale Socks</a></li>
                                            <li><a href="{{ route('sale.men.socks.category', 'crew') }}" class="hover:underline">Crew Socks</a></li>
                                            <li><a href="{{ route('sale.men.socks.category', 'ankle') }}" class="hover:underline">Ankle Socks</a></li>
                                        </ul>
                                    </div>
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

                <!-- ── WOMEN ── -->
                <div class="nav-item" id="nav-women">
                    <a href="{{ route('women.index') }}">Women</a>

                    <div class="mega-menu">
                        <div class="sub-tab-bar">
                            <button class="sub-tab active" onmouseenter="switchPanel('women','shoes',this)">Shoes</button>
                            <button class="sub-tab" onmouseenter="switchPanel('women','apparel',this)">Socks & Apparel</button>
                            <button class="sub-tab sale-tab" onmouseenter="switchPanel('women','sale',this)">Sale</button>
                        </div>

                        <!-- Women Shoes -->
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
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customer Favorites</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('women.product', 'tree-runner') }}" class="hover:underline">Tree Runner</a></li>
                                            <li><a href="{{ route('women.product', 'tree-dasher') }}" class="hover:underline">Tree Dasher</a></li>
                                            <li><a href="{{ route('women.product', 'varsity') }}" class="hover:underline">Varsity</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('women.collection', 'dasher-nz') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img6.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px]">Dasher NZ Collection</span>
                                    </a>
                                    <div class="flex flex-col gap-3">
                                        <a href="{{ route('women.collection', 'varsity') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img7.webp') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Varsity Collection</span>
                                        </a>
                                        <a href="{{ route('women.new-arrivals') }}" class="mega-menu-image w-44 h-[138px]">
                                           <img src="{{ asset('images/img8.jpg') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Women's New Arrivals</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Women Apparel -->
                         <div class="sub-panel" id="women-apparel">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('women.apparel.collection', 'new-arrivals') }}" class="hover:underline">New Arrivals</a></li>
                                        <li><a href="{{ route('women.apparel.collection', 'bestsellers') }}" class="hover:underline">Bestsellers</a></li>
                                        <li><a href="{{ route('women.apparel.collection', 'tree-apparel') }}" class="hover:underline">Tree Apparel</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Socks</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('women.socks') }}" class="hover:underline italic">All Socks</a></li>
                                            <li><a href="{{ route('women.socks.category', 'no-show') }}" class="hover:underline">No Show</a></li>
                                            <li><a href="{{ route('women.socks.category', 'ankle') }}" class="hover:underline">Ankle</a></li>
                                            <li><a href="{{ route('women.socks.category', 'crew') }}" class="hover:underline">Crew</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Women's Apparel</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                           <li><a href="{{ route('women.apparel') }}" class="hover:underline italic">All Apparel</a></li>
                                           <li><a href="{{ route('women.apparel.category', 'tees') }}" class="hover:underline">Tees</a></li>
                                           <li><a href="{{ route('women.apparel.category', 'leggings') }}" class="hover:underline">Leggings</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('women.apparel.new') }}" class="mega-menu-image w-60 h-72">
                                       <img src="{{ asset('images/img9.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px]">New in Apparel</span>
                                    </a>
                                    <div class="flex flex-col gap-3">
                                        <a href="{{ route('women.socks') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img10.webp') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Socks</span>
                                        </a>
                                        <a href="{{ route('accessories') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img5.webp') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Accessories</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Women Sale -->
                        <div class="sub-panel" id="women-sale">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('sale.women', ['discount' => '50']) }}" class="hover:underline text-red-600">Up to 50% Off</a></li>
                                        <li><a href="{{ route('sale.women.clearance') }}" class="hover:underline">Clearance</a></li>
                                        <li><a href="{{ route('sale.women.last-chance') }}" class="hover:underline">Last Chance</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sale Shoes</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.women.shoes') }}" class="hover:underline italic">Shop All Sale Shoes</a></li>
                                            <li><a href="{{ route('sale.women.shoes.category', 'sneakers') }}" class="hover:underline">Sneakers</a></li>
                                            <li><a href="{{ route('sale.women.shoes.category', 'flats') }}" class="hover:underline">Flats</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sale Apparel</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.women.apparel') }}" class="hover:underline italic">Shop All Sale Apparel</a></li>
                                            <li><a href="{{ route('sale.women.apparel.category', 'tees') }}" class="hover:underline">Tees</a></li>
                                            <li><a href="{{ route('sale.women.apparel.category', 'leggings') }}" class="hover:underline">Leggings</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sale Socks</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.women.socks') }}" class="hover:underline italic">Shop All Sale Socks</a></li>
                                            <li><a href="{{ route('sale.women.socks.category', 'crew') }}" class="hover:underline">Crew Socks</a></li>
                                            <li><a href="{{ route('sale.women.socks.category', 'ankle') }}" class="hover:underline">Ankle Socks</a></li>
                                        </ul>
                                    </div>
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

                <!-- ── SALE ── -->
                <div class="nav-item sale-item" id="nav-sale">
                    <a href="{{ route('sale.index') }}" style="color:#dc2626;">Sale</a>

                    <div class="mega-menu">
                        <div class="sub-tab-bar">
                            <button class="sub-tab sale-tab active" onmouseenter="switchPanel('sale','featured',this)">Featured Deals</button>
                            <button class="sub-tab" onmouseenter="switchPanel('sale','shoes',this)">Shoes</button>
                            <button class="sub-tab" onmouseenter="switchPanel('sale','apparel',this)">Apparel</button>
                            <button class="sub-tab" onmouseenter="switchPanel('sale','socks',this)">Socks</button>
                        </div>

                        <!-- Sale Featured -->
                        <div class="sub-panel active" id="sale-featured">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('sale.index') }}" class="hover:underline text-red-600">Up to 50% Off</a></li>
                                        <li><a href="{{ route('sale.men.clearance') }}" class="hover:underline">Men's Clearance</a></li>
                                        <li><a href="{{ route('sale.women.clearance') }}" class="hover:underline">Women's Clearance</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Men's Sale</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.men.shoes') }}" class="hover:underline">Sale Shoes</a></li>
                                            <li><a href="{{ route('sale.men.apparel') }}" class="hover:underline">Sale Apparel</a></li>
                                            <li><a href="{{ route('sale.men.socks') }}" class="hover:underline">Sale Socks</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Women's Sale</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.women.shoes') }}" class="hover:underline">Sale Shoes</a></li>
                                            <li><a href="{{ route('sale.women.apparel') }}" class="hover:underline">Sale Apparel</a></li>
                                            <li><a href="{{ route('sale.women.socks') }}" class="hover:underline">Sale Socks</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.index') }}" class="mega-menu-image w-60 h-72">
                                       <img src="{{ asset('images/img10.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Up to 50% Off</span>
                                    </a>
                                    <div class="flex flex-col gap-3">
                                        <a href="{{ route('sale.shoes') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img4.webp') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Sale Shoes</span>
                                        </a>
                                        <a href="{{ route('sale.category', 'apparel') }}" class="mega-menu-image w-44 h-[138px]">
                                            <img src="{{ asset('images/img5.webp') }}" class="h-full w-full object-cover">
                                            <span class="absolute bottom-3 left-3 text-white font-bold uppercase text-[8px]">Sale Apparel</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sale Shoes -->
                        <div class="sub-panel" id="sale-shoes">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('sale.men.shoes') }}" class="hover:underline text-red-600">Men's Sale Shoes</a></li>
                                        <li><a href="{{ route('sale.women.shoes') }}" class="hover:underline text-red-600">Women's Sale Shoes</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Men's Styles</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.men.shoes.category', 'sneakers') }}" class="hover:underline">Sneakers</a></li>
                                            <li><a href="{{ route('sale.men.shoes.category', 'running') }}" class="hover:underline">Running</a></li>
                                            <li><a href="{{ route('sale.men.shoes.category', 'slip-ons') }}" class="hover:underline">Slip Ons</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Women's Styles</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.women.shoes.category', 'sneakers') }}" class="hover:underline">Sneakers</a></li>
                                            <li><a href="{{ route('sale.women.shoes.category', 'flats') }}" class="hover:underline">Flats</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.shoes') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img5.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Sale Shoes</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Sale Apparel -->
                        <div class="sub-panel" id="sale-apparel">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('sale.men.apparel') }}" class="hover:underline text-red-600">Men's Sale Apparel</a></li>
                                        <li><a href="{{ route('sale.women.apparel') }}" class="hover:underline text-red-600">Women's Sale Apparel</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Men's Apparel</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.men.apparel.category', 'tees') }}" class="hover:underline">Tees</a></li>
                                            <li><a href="{{ route('sale.men.apparel.category', 'sweats') }}" class="hover:underline">Sweats</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Women's Apparel</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.women.apparel.category', 'tees') }}" class="hover:underline">Tees</a></li>
                                            <li><a href="{{ route('sale.women.apparel.category', 'leggings') }}" class="hover:underline">Leggings</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.category', 'apparel') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img9.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Sale Apparel</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Sale Socks -->
                        <div class="sub-panel" id="sale-socks">
                            <div class="panel-inner">
                                <div class="flex gap-14">
                                    <ul class="text-[11px] font-bold space-y-4 tracking-tighter uppercase text-black">
                                        <li><a href="{{ route('sale.men.socks') }}" class="hover:underline text-red-600">Men's Sale Socks</a></li>
                                        <li><a href="{{ route('sale.women.socks') }}" class="hover:underline text-red-600">Women's Sale Socks</a></li>
                                    </ul>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Men's Socks</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.men.socks.category', 'crew') }}" class="hover:underline">Crew</a></li>
                                            <li><a href="{{ route('sale.men.socks.category', 'ankle') }}" class="hover:underline">Ankle</a></li>
                                            <li><a href="{{ route('sale.men.socks.category', 'no-show') }}" class="hover:underline">No Show</a></li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Women's Socks</h3>
                                        <ul class="text-[13px] space-y-2 text-gray-700 font-normal">
                                            <li><a href="{{ route('sale.women.socks.category', 'crew') }}" class="hover:underline">Crew</a></li>
                                            <li><a href="{{ route('sale.women.socks.category', 'ankle') }}" class="hover:underline">Ankle</a></li>
                                            <li><a href="{{ route('sale.women.socks.category', 'no-show') }}" class="hover:underline">No Show</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex gap-3 ml-8">
                                    <a href="{{ route('sale.men.socks') }}" class="mega-menu-image w-60 h-72">
                                        <img src="{{ asset('images/img5.webp') }}" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 text-white font-bold uppercase text-[9px] bg-red-600 px-2 py-1">Sale Socks</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end nav-wrapper -->

            <!-- Right icons -->
            <div class="flex-1 flex items-center justify-end space-x-5 text-gray-800">
                <a href="#" class="text-[12px] font-bold hover:underline">About</a>
               <a href="{{ url()->current() }}" class="text-[12px] font-bold hover:underline">ReRun</a>
               <a href="{{ route('search') }}" class="block">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
</a>
                <a href="#"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path></svg></a>
                <a href="#"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path></svg></a>
                <button onclick="openCart()" class="relative bg-transparent border-0 cursor-pointer p-0">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
        <path d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z"></path>
    </svg>
    @php
        $cartCount = array_sum(array_column(session('cart', []), 'quantity'));
    @endphp
    @if($cartCount > 0)
    <span class="absolute -top-1.5 -right-1.5 bg-black text-white text-[9px] w-4 h-4 flex items-center justify-center rounded-full font-bold">{{ $cartCount }}</span>
    @endif
</button>
            </div>
        </div>
    </nav>
    <!-- Search Modal -->
<div id="searchModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[9999]" style="top: 0;" onclick="closeSearch()">
    <div class="bg-white w-full max-w-2xl mx-auto mt-32 rounded-lg shadow-2xl" onclick="event.stopPropagation()">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Search</h2>
                <button onclick="closeSearch()" class="text-gray-400 hover:text-black text-3xl leading-none">&times;</button>
            </div>
            
            <form action="{{ route('search') }}" method="GET">
                <div class="relative">
                    <input 
                        type="text" 
                        name="q" 
                        id="searchInput"
                        placeholder="Search for shoes, apparel, or collections..." 
                        class="w-full border-2 border-gray-300 rounded-lg px-6 py-4 pr-12 text-lg focus:outline-none focus:border-black"
                    >
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>
            
            <!-- Quick Links -->
            <div class="mt-6">
                <p class="text-sm text-gray-500 mb-3 font-semibold">Popular Searches:</p>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('men.shoes.category', 'sneakers') }}" class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 transition">Sneakers</a>
                    <a href="{{ route('men.shoes.category', 'slip-ons') }}" class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 transition">Slip Ons</a>
                    <a href="{{ route('sale.index') }}" class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm hover:bg-red-200 transition">Sale</a>
                    <a href="{{ route('men.apparel') }}" class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 transition">Apparel</a>
                    <a href="{{ route('men.socks') }}" class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 transition">Socks</a>
                </div>
            </div>
        </div>
    </div>
</div>
</header>

<main>
    @yield('content')
</main>

<!-- Cart Overlay -->
<div class="cart-overlay" id="cartOverlay"></div>

<!-- Cart Sidebar -->
<div class="cart-sidebar" id="cartSidebar">

    {{-- Progress bar --}}
    @php
        $sidebarCart = session('cart', []);
        $sidebarSubtotal = 0;
        foreach ($sidebarCart as $sidebarItem) {
            $sidebarSubtotal += $sidebarItem['price'] * $sidebarItem['quantity'];
        }
        $freeShippingThreshold = 75;
        $remaining = max(0, $freeShippingThreshold - $sidebarSubtotal);
    @endphp

    <div class="cart-progress">
        @if($remaining > 0)
            <p>Spend <strong>${{ number_format($remaining, 2) }}</strong> more to get free shipping!</p>
        @else
            <p>🎉 You've earned free shipping!</p>
        @endif
    </div>

    {{-- Cart Header --}}
    <div class="cart-header">
        <h2 class="cart-title">
            CART ({{ array_sum(array_column($sidebarCart, 'quantity')) }})
        </h2>
        <button class="cart-close" id="cartClose">&times;</button>
    </div>

    {{-- Cart Body --}}
    <div class="cart-body" id="cartBody">
        <div class="cart-items" id="cartItems">

            @forelse($sidebarCart as $itemId => $sidebarItem)
                <div class="cart-item">

                    {{-- Product Image --}}
                    <div class="cart-item-image">
                        <img
                            src="{{ asset($sidebarItem['image']) }}"
                            alt="{{ $sidebarItem['name'] }}"
                            onerror="this.src='https://via.placeholder.com/80x80?text=Product'"
                        >
                    </div>

                    {{-- Product Details --}}
                    <div class="cart-item-details">
                        <h3 class="cart-item-name">{{ strtoupper($sidebarItem['name']) }}</h3>

                        @if(!empty($sidebarItem['color']))
                            <p class="cart-item-variant">{{ $sidebarItem['color'] }}</p>
                        @endif

                        <p class="cart-item-size">Size: {{ $sidebarItem['size'] }}</p>

                        {{-- Remove button --}}
                        <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $itemId }}">
                            <button type="submit" class="cart-item-remove">Remove</button>
                        </form>
                    </div>

                    {{-- Price + Quantity --}}
                    <div class="cart-item-right">
                        <p class="cart-item-price">${{ number_format($sidebarItem['price'] * $sidebarItem['quantity'], 2) }}</p>

                        <div class="cart-item-quantity">
                            {{-- Decrease --}}
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $itemId }}">
                                <input type="hidden" name="quantity" value="{{ $sidebarItem['quantity'] - 1 }}">
                                <button type="submit" class="qty-btn">−</button>
                            </form>

                            <span class="qty-input" style="width:40px;text-align:center;font-weight:600;">
                                {{ $sidebarItem['quantity'] }}
                            </span>

                            {{-- Increase --}}
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $itemId }}">
                                <input type="hidden" name="quantity" value="{{ $sidebarItem['quantity'] + 1 }}">
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

        </div>
    </div>

    {{-- Cart Footer (only show if cart has items) --}}
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

        <a href="{{ route('checkout') }}" class="cart-checkout-btn" style="display:block;text-align:center;text-decoration:none;">
            CHECKOUT — ${{ number_format($sidebarSubtotal, 2) }}
        </a>

        <div class="cart-payment-options">
            <button class="payment-option-btn">amazon pay</button>
            <button class="payment-option-btn paypal">PayPal</button>
            <button class="payment-option-btn shop-pay">Shop Pay</button>
        </div>
    </div>
    @endif

</div>
<script>
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
    document.getElementById('cartOverlay')?.addEventListener('click', closeCart);
    document.getElementById('cartClose')?.addEventListener('click', closeCart);
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeCart();
    });
</script>

<script>
    // Safe cart functions
    function openCart() {
        const overlay = document.getElementById('cartOverlay');
        const sidebar = document.getElementById('cartSidebar');
        if (overlay && sidebar) {
            overlay.classList.add('active');
            sidebar.classList.add('active');
            document.body.style.overflow = 'hidden';
        } else {
            console.warn('Cart elements not found on this page.');
        }
    }

    function closeCart() {
        const overlay = document.getElementById('cartOverlay');
        const sidebar = document.getElementById('cartSidebar');
        if (overlay && sidebar) {
            overlay.classList.remove('active');
            sidebar.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // Attach event listeners only if elements exist
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('cartOverlay');
        const closeBtn = document.getElementById('cartClose');
        if (overlay) overlay.addEventListener('click', closeCart);
        if (closeBtn) closeBtn.addEventListener('click', closeCart);
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeCart();
        });
    });

    // Mega menu functions (unchanged)
    function switchPanel(menu, panel, hoveredBtn) {
        const navItem = document.getElementById('nav-' + menu);
        if (!navItem) return;
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
            const firstTab = navItem.querySelector('.sub-tab');
            if (firstPanel) firstPanel.classList.add('active');
            if (firstTab) firstTab.classList.add('active');
        };
        const showMenu = () => {
            clearTimeout(leaveTimer);
            const megaMenu = navItem.querySelector('.mega-menu');
            if (megaMenu) megaMenu.style.display = 'block';
        };
        const delayHide = () => {
            leaveTimer = setTimeout(hideMenu, 100);
        };
        navItem.addEventListener('mouseenter', showMenu);
        navItem.addEventListener('mouseleave', delayHide);
        const megaMenu = navItem.querySelector('.mega-menu');
        if (megaMenu) {
            megaMenu.addEventListener('mouseenter', showMenu);
            megaMenu.addEventListener('mouseleave', delayHide);
        }
    });
</script>
<script>
    function switchPanel(menu, panel, hoveredBtn) {
        const navItem = document.getElementById('nav-' + menu);
        navItem.querySelectorAll('.sub-panel').forEach(p => p.classList.remove('active'));
        navItem.querySelectorAll('.sub-tab').forEach(t => t.classList.remove('active'));
        const target = document.getElementById(menu + '-' + panel);
        if (target) target.classList.add('active');
        hoveredBtn.classList.add('active');
    }

    // Better menu handling
    document.querySelectorAll('.nav-item').forEach(navItem => {
        let leaveTimer;
        
        const hideMenu = () => {
            const megaMenu = navItem.querySelector('.mega-menu');
            if (megaMenu) {
                megaMenu.style.display = 'none';
            }
            navItem.querySelectorAll('.sub-panel').forEach(p => p.classList.remove('active'));
            navItem.querySelectorAll('.sub-tab').forEach(t => t.classList.remove('active'));
            const firstPanel = navItem.querySelector('.sub-panel');
            const firstTab = navItem.querySelector('.sub-tab');
            if (firstPanel) firstPanel.classList.add('active');
            if (firstTab) firstTab.classList.add('active');
        };

        const showMenu = () => {
            clearTimeout(leaveTimer);
            const megaMenu = navItem.querySelector('.mega-menu');
            if (megaMenu) {
                megaMenu.style.display = 'block';
            }
        };

        const delayHide = () => {
            leaveTimer = setTimeout(hideMenu, 100);
        };

        navItem.addEventListener('mouseenter', showMenu);
        navItem.addEventListener('mouseleave', delayHide);
        
        const megaMenu = navItem.querySelector('.mega-menu');
        if (megaMenu) {
            megaMenu.addEventListener('mouseenter', showMenu);
            megaMenu.addEventListener('mouseleave', delayHide);
        }
    });

    // Cart functionality
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

    // Quantity controls
    function increaseQty(btn) {
        const input = btn.parentElement.querySelector('.qty-input');
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQty(btn) {
        const input = btn.parentElement.querySelector('.qty-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    // Event listeners
    document.getElementById('cartOverlay').addEventListener('click', closeCart);
    document.getElementById('cartClose').addEventListener('click', closeCart);

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCart();
        }
    });
</script>

</body>
<footer class="bg-[#0f0f0f] text-gray-300 text-sm">
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-12">

            <!-- Newsletter + Main Links Grid -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-10 md:gap-6 lg:gap-8 mb-16">

                <!-- Newsletter Signup -->
                <div class="md:col-span-2">
                    <form class="flex flex-col sm:flex-row gap-3 max-w-md">
                        <h2>Subscribe to our emails</h2>
                        <input 
                            type="email" 
                            placeholder="Email Address" 
                            class="flex-1 bg-transparent border border-gray-600 rounded-full px-6 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-gray-400 transition"
                        >
                        <button 
                            type="submit"
                            class="bg-white text-black font-medium px-8 py-3 rounded-full hover:bg-gray-200 transition whitespace-nowrap"
                        >
                            SIGN UP
                        </button>
                    </form>
                </div>

                <!-- Links Columns -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:col-span-3 gap-x-8 gap-y-10 text-gray-400">
                    <!-- Column 1 -->
                    <div>
                        <ul class="space-y-3">
                            <li><a href="#" class="hover:text-white transition">Live Chat</a></li>
                            <li><a href="#" class="hover:text-white transition">Call Us</a></li>
                            <li><a href="#" class="hover:text-white transition">Text Us</a></li>
                            <li><a href="mailto:help@allbirds.com" class="hover:text-white transition">help@allbirds.com</a></li>
                            <li><a href="#" class="hover:text-white transition">FAQ/Contact Us</a></li>
                        </ul>
                    </div>

                    <!-- Column 2 -->
                    <div>
                        <ul class="space-y-3">
                            <li><a href="#" class="hover:text-white transition">Men's Shoes</a></li>
                            <li><a href="#" class="hover:text-white transition">Women's Shoes</a></li>
                            <li><a href="#" class="hover:text-white transition">Men's Apparel</a></li>
                            <li><a href="#" class="hover:text-white transition">Women's Apparel</a></li>
                            <li><a href="#" class="hover:text-white transition">Socks</a></li>
                            <li><a href="#" class="hover:text-white transition">Returns/Exchanges</a></li>
                            <li><a href="#" class="hover:text-white transition">Gift Cards</a></li>
                        </ul>
                    </div>

                    <!-- Column 3 -->
                    <div>
                        <ul class="space-y-3">
                            <li><a href="#" class="hover:text-white transition">Our Stores</a></li>
                            <li><a href="#" class="hover:text-white transition">Our Story</a></li>
                            <li><a href="#" class="hover:text-white transition">Our Materials</a></li>
                            <li><a href="#" class="hover:text-white transition">Sustainability</a></li>
                            <li><a href="#" class="hover:text-white transition">Investors</a></li>
                            <li><a href="#" class="hover:text-white transition">Shoe Care</a></li>
                            <li><a href="#" class="hover:text-white transition">Our Blog</a></li>
                        </ul>
                    </div>

                    <!-- Column 4 -->
                    <div>
                        <ul class="space-y-3">
                            <li><a href="#" class="hover:text-white transition">Careers</a></li>
                            <li><a href="#" class="hover:text-white transition">Press</a></li>
                            <li><a href="#" class="hover:text-white transition">Allbirds Responsible</a></li>
                            <li><a href="#" class="hover:text-white transition">Disclosure Program</a></li>
                            <li><a href="#" class="hover:text-white transition">California Transparency Act</a></li>
                            <li><a href="#" class="hover:text-white transition">Community Offers</a></li>
                        </ul>
                    </div>

                    <!-- Column 5 -->
                    <div class="col-span-2 sm:col-span-1">
                        <ul class="space-y-3">
                            <li><a href="#" class="hover:text-white transition">Refer a Friend</a></li>
                            <li><a href="#" class="hover:text-white transition">Affiliates</a></li>
                            <li><a href="#" class="hover:text-white transition">Bulk Orders</a></li>
                            <li><a href="#" class="hover:text-white transition">Patents</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms of Use - Wholesale</a></li>
                            <li><a href="#" class="hover:text-white transition">Allbirds Global Entities</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Social + Certification + Bottom Bar -->
            <div class="border-t border-gray-800 pt-10">

                <!-- Social Media Icons -->
                <div class="mb-10">
                    <p class="text-gray-400 uppercase tracking-wider text-xs mb-4 font-medium">FOLLOW THE FLOCK</p>
                    <div class="flex gap-6">
                        <!-- Instagram -->
                        <a href="#" class="hover:text-white transition" aria-label="Instagram">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.332.014 7.052.072 2.579.227.228 2.578.072 7.052.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.156 4.474 2.507 6.825 6.98 6.98C8.332 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.474-.156 6.825-2.507 6.98-6.98.058-1.28.072-1.689.072-4.948 0-3.259-.014-3.668-.072-4.948-.156-4.474-2.507-6.825-6.98-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                            </svg>
                        </a>

                        <!-- Pinterest -->
                        <a href="#" class="hover:text-white transition" aria-label="Pinterest">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.779c0-1.667.967-2.914 2.167-2.914 1.023 0 1.518.769 1.518 1.688 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.085.345-.057.244-.184.788-.236 1.003-.068.271-.225.329-.526.197-1.96-.912-3.188-3.775-3.188-6.082 0-4.953 3.599-9.502 10.368-9.502 5.444 0 9.676 3.88 9.676 9.07 0 5.406-3.41 9.758-8.143 9.758-1.59 0-3.089-.826-3.602-1.802-.001 0-.787 2.997-.979 3.748-.223.854-.826 1.898-1.233 2.541-.519.836-1.048 1.17-1.602 1.202z"/>
                            </svg>
                        </a>

                        <!-- Facebook -->
                        <a href="#" class="hover:text-white transition" aria-label="Facebook">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12c0-6.627-5.373-12-12-12S0 5.373 0 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 22.954 24 17.99 24 12z"/>
                            </svg>
                        </a>

                        <!-- X (Twitter) -->
                        <a href="#" class="hover:text-white transition" aria-label="X">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>

                        <!-- TikTok -->
                        <a href="#" class="hover:text-white transition" aria-label="TikTok">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.53.02C13.84 0 15.14.01 16.44.02c.08 1.53.63 3.09 1.81 4.13 1.09 1 2.5.83 3.75.83v4.03c-1.44.04-2.92-.24-4.05-1.13-1.13-.89-1.81-2.44-1.92-3.97-.01-.01-.02-.01-.03-.01v7.84c0 4.98-4.03 9.01-9.01 9.01-2.16 0-4.17-.76-5.74-2.04 1.78 1.6 4.09 2.57 6.66 2.57 4.98 0 9.01-4.03 9.01-9.01V.02zM5.84 19.71c-.57-.58-.91-1.38-.91-2.26 0-1.76 1.43-3.19 3.19-3.19.44 0 .86.09 1.24.26v4.45c-.38.17-.8.26-1.24.26-.81 0-1.55-.31-2.11-.89z"/>
                            </svg>
                        </a>

                        <!-- YouTube -->
                        <a href="#" class="hover:text-white transition" aria-label="YouTube">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.121 2.136c1.872.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Certification & Region -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="text-green-500 text-4xl font-bold">B</div>
                        <div>
                            <p class="text-white font-medium">Certified</p>
                            <p class="text-xs text-gray-500">Corporation</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 text-gray-400">
                        <span>US</span>
                        <span class="text-xl">▼</span>
                    </div>
                </div>

                <!-- Bottom legal line -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 text-xs text-gray-500 border-t border-gray-800 pt-6">
                    <p>© 2025 Allbirds, Inc. All Rights Reserved</p>
                    <div class="flex flex-wrap gap-x-6 gap-y-2">
                        <a href="#" class="hover:text-gray-300 transition">Refund policy</a>
                        <a href="#" class="hover:text-gray-300 transition">Privacy policy</a>
                        <a href="#" class="hover:text-gray-300 transition">Terms of service</a>
                        <a href="#" class="hover:text-gray-300 transition">Do Not Sell My Personal Information</a>
                        <a href="#" class="hover:text-gray-300 transition">California Transparency Act</a>
                    </div>
                </div>

            </div>

        </div>
    </footer>
</html>
