@extends('layouts.app')

@section('content')

    <section class="max-w-[1440px] mx-auto px-4 md:px-6 mt-6 mb-12">
        <div class="relative rounded-[2.5rem] overflow-hidden h-[85vh] shadow-2xl bg-gray-100">
            
            <img
                src="{{ asset('images/hero.jpeg') }}"
                class="absolute inset-0 w-full h-full object-cover"
                alt="Dasher NZ Collection"
            >

            <div class="absolute inset-0 bg-black/10"></div>

            <div class="absolute top-1/2 left-12 -translate-y-1/2 text-white flex flex-col items-center">
                <p class="font-serif italic text-2xl mb-2 drop-shadow-md">Made From Trees</p>
                <div class="w-16 h-[1px] bg-white/70"></div>
            </div>

            <div class="absolute bottom-16 right-12 text-white text-right z-10">
                <p class="text-[11px] uppercase tracking-[0.3em] font-black mb-4 opacity-90 drop-shadow-md">
                    All New Dasher NZ Collection
                </p>

                <h1 class="text-5xl md:text-7xl font-bold leading-[1.05] mb-10 drop-shadow-lg">
                    Wildly Comfortable.<br>
                    Super Natural.
                </h1>

                <div class="flex gap-4 justify-end">
                    <a href="{{ route('men.shoes') }}" class="btn-hero inline-block text-center">
                        Shop Men
                    </a>
                    <a href="{{ route('women.shoes') }}" class="btn-hero inline-block text-center">
                        Shop Women
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="section-2" class="bg-[#f5f2ed] py-16 px-6">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="relative group h-[550px] w-full overflow-hidden rounded-[40px] transition-all duration-700 ease-in-out hover:rounded-[275px] cursor-pointer">
                    <img src="{{ asset('images/new arival.jpeg') }}" alt="New Arrivals" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/45 transition-all duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                        <span class="text-white text-[13px] sm:text-[15px] font-bold uppercase tracking-[0.25em] drop-shadow-lg mb-6 z-10">
                            New Arrivals
                        </span>
                        <a href="{{ route('shop') }}" 
                           class="px-8 py-3 min-w-[160px] border border-white text-white text-xs font-bold uppercase tracking-[0.2em] rounded-full backdrop-blur-sm opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 hover:bg-white hover:text-black transition-all duration-500 ease-out text-center">
                            Shop Now
                        </a>
                    </div>
                </div>

                <div class="relative group h-[550px] w-full overflow-hidden rounded-[40px] transition-all duration-700 ease-in-out hover:rounded-[275px] cursor-pointer">
                    <img src="{{ asset('images/men.jpeg') }}" alt="Mens" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/45 transition-all duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                        <span class="text-white text-[13px] sm:text-[15px] font-bold uppercase tracking-[0.25em] drop-shadow-lg mb-6 z-10">
                            Mens
                        </span>
                        <a href="{{ route('men.shoes') }}" 
                           class="px-8 py-3 min-w-[160px] border border-white text-white text-xs font-bold uppercase tracking-[0.2em] rounded-full backdrop-blur-sm opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 hover:bg-white hover:text-black transition-all duration-500 ease-out text-center">
                            Shop Men
                        </a>
                    </div>
                </div>

                <div class="relative group h-[550px] w-full overflow-hidden rounded-[40px] transition-all duration-700 ease-in-out hover:rounded-[275px] cursor-pointer">
                    <img src="{{ asset('images/woman.jpeg') }}" alt="Womens" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/45 transition-all duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                        <span class="text-white text-[13px] sm:text-[15px] font-bold uppercase tracking-[0.25em] drop-shadow-lg mb-6 z-10">
                            Womens
                        </span>
                        <a href="{{ route('women.shoes') }}" 
                           class="px-8 py-3 min-w-[160px] border border-white text-white text-xs font-bold uppercase tracking-[0.2em] rounded-full backdrop-blur-sm opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 hover:bg-white hover:text-black transition-all duration-500 ease-out text-center">
                            Shop Women
                        </a>
                    </div>
                </div>

                <div class="relative group h-[550px] w-full overflow-hidden rounded-[40px] transition-all duration-700 ease-in-out hover:rounded-[275px] cursor-pointer">
                    <img src="{{ asset('images/best seller.jpeg') }}" alt="Bestsellers" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/45 transition-all duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                        <span class="text-white text-[13px] sm:text-[15px] font-bold uppercase tracking-[0.25em] drop-shadow-lg mb-6 z-10">
                            Bestsellers
                        </span>
                        <div class="flex flex-col gap-4 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 ease-out">
                            <a href="{{ route('men.shoes') }}" 
                               class="px-8 py-3 min-w-[160px] border border-white text-white text-xs font-bold uppercase tracking-[0.2em] rounded-full backdrop-blur-sm hover:bg-white hover:text-black transition-all duration-300 text-center">
                                Shop Men
                            </a>
                            <a href="{{ route('women.shoes') }}" 
                               class="px-8 py-3 min-w-[160px] border border-white text-white text-xs font-bold uppercase tracking-[0.2em] rounded-full backdrop-blur-sm hover:bg-white hover:text-black transition-all duration-300 text-center">
                                Shop Women
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-[#f5f2ed] py-20">
        <div class="slider-container">
            <div class="text-center mb-10">
                <a href="{{ route('shop') }}" class="label tracking-[0.3em] font-bold text-[11px] underline uppercase hover:text-gray-600 transition-colors">
                    NEW ARRIVALS
                </a>
            </div>
            
            <div class="dotted-wrapper relative" id="dottedArea">
                <div class="slider-track" id="track">
                    <div class="slide"><img src="{{ asset('images/yellow1.webp') }}" alt=""></div>
                    <div class="slide"><img src="{{ asset('images/red1.webp') }}" alt=""></div>
                    <div class="slide"><img src="{{ asset('images/lightgrey1.webp') }}" alt=""></div>
                    <div class="slide"><img src="{{ asset('images/gradient1.webp') }}" alt=""></div>
                    <div class="slide"><img src="{{ asset('images/') }}" alt=""></div>
                </div>
                <div id="cursorArrow" class="floating-arrow pointer-events-none">→</div>
            </div>
        </div>
    </section>

    <section class="section-4">
        <div class="header-content">
            <h1>Cruiser Slip On Canvas</h1>
            <p>Blizzard (Blizzard Sole) • <strong>$90</strong></p>
            <div class="button-group">
                <a href="{{ route('men.shoes') }}" class="btn">SHOP MEN</a>
                <a href="{{ route('women.shoes') }}" class="btn">SHOP WOMEN</a>
            </div>
        </div>

        <div class="image-grid">
            <div class="grid-card">
                <div class="img-container">
                    <img src="{{ asset('images/section4.webp') }}" alt="The Perfect Valentine">
                </div>
                <div class="card-overlay">
                    <h2 class="overlay-title">The Perfect Valentine</h2>
                    <div class="card-buttons">
                        <a href="{{ route('men.shoes') }}" class="btn-outline">SHOP MEN</a>
                        <a href="{{ route('women.shoes') }}" class="btn-outline">SHOP WOMEN</a>
                    </div>
                </div>
            </div>
            <div class="grid-card">
                <div class="img-container">
                    <img src="{{ asset('images/section4two.webp') }}" alt="Varsity Collection">
                </div>
                <div class="card-overlay">
                    <h2 class="overlay-title">Varsity Collection</h2>
                    <div class="card-buttons">
                        <a href="{{ route('men.shoes') }}" class="btn-outline">SHOP MEN</a>
                        <a href="{{ route('women.shoes') }}" class="btn-outline">SHOP WOMEN</a>
                    </div>
                </div>
            </div>
            <div class="grid-card">
                <div class="img-container">
                    <img src="{{ asset('images/section4three.webp') }}" alt="Dasher NZ Collection">
                </div>
                <div class="card-overlay">
                    <h2 class="overlay-title">Dasher NZ Collection</h2>
                    <div class="card-buttons">
                        <a href="{{ route('men.shoes') }}" class="btn-outline">SHOP MEN</a>
                        <a href="{{ route('women.shoes') }}" class="btn-outline">SHOP WOMEN</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <section id="section-5" class="bg-[#f2f0eb] py-16 px-6 md:px-12 font-sans overflow-hidden">
        <div class="flex justify-between items-center mb-8">
            <div class="relative">
                <a href="{{ route('shop') }}" class="text-sm font-bold tracking-[0.2em] uppercase border-b-2 border-black pb-1 hover:text-gray-600 transition-colors">
                    New Arrivals
                </a>
            </div>
            <div class="flex gap-3">
                <button class="swiper-prev-btn w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center bg-white/50 hover:bg-white transition-all shadow-sm cursor-pointer disabled:opacity-30">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="swiper-next-btn w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center bg-white/50 hover:bg-white transition-all shadow-sm cursor-pointer disabled:opacity-30">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="swiper newArrivalsSwiper">
            <div class="swiper-wrapper">
                @foreach(range(1, 10) as $index)
                <div class="swiper-slide">
                    <a href="{{ route('shop') }}" class="group block bg-white rounded-lg p-6 relative transition-shadow hover:shadow-md h-full">
                        <span class="absolute top-4 left-4 bg-[#e8e6e1] text-[10px] font-bold px-2 py-1 rounded uppercase tracking-tighter">New</span>
                        <div class="aspect-square flex items-center justify-center mb-8">
                          <img src="{{ asset('images/' . $index . '.jpg') }}" alt="Shoe {{ $index }}" class="w-full h-auto object-contain transform group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-[13px] font-bold uppercase tracking-tight">Product Title {{ $index }}</h3>
                            <p class="text-[13px] text-gray-600">Limited Edition Color</p>
                            <div class="flex justify-between items-center mt-4">
                                <div class="w-7 h-7 rounded-full border border-gray-400 p-0.5 flex items-center justify-center">
                                    <div class="w-5 h-5 rounded-full bg-gray-800"></div>
                                </div>
                                <span class="font-bold text-[13px]">$125</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="section-6" class="bg-[#f2f0eb] pb-16 px-6 md:px-12 font-sans">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-8 min-h-[280px] flex flex-col justify-start transition-shadow hover:shadow-sm">
                <h4 class="text-[11px] font-bold tracking-[0.2em] uppercase mb-6 text-gray-800">Wear All Day Comfort</h4>
                <p class="text-[15px] leading-relaxed text-gray-900 font-medium">Lightweight, bouncy, and wildly comfortable, Allbirds shoes make any outing feel effortless.</p>
            </div>
            <div class="bg-white rounded-xl p-8 min-h-[280px] flex flex-col justify-start transition-shadow hover:shadow-sm">
                <h4 class="text-[11px] font-bold tracking-[0.2em] uppercase mb-6 text-gray-800">Sustainability In Every Step</h4>
                <p class="text-[15px] leading-relaxed text-gray-900 font-medium">From materials to transport, we're working to reduce our carbon footprint to near zero.</p>
            </div>
            <div class="bg-white rounded-xl p-8 min-h-[280px] flex flex-col justify-start transition-shadow hover:shadow-sm">
                <h4 class="text-[11px] font-bold tracking-[0.2em] uppercase mb-6 text-gray-800">Materials From The Earth</h4>
                <p class="text-[15px] leading-relaxed text-gray-900 font-medium">We replace petroleum-based synthetics with natural alternatives like wool and tree fiber.</p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.newArrivalsSwiper', {
            slidesPerView: 1.2,
            spaceBetween: 16,
            grabCursor: true,
            navigation: { nextEl: '.swiper-next-btn', prevEl: '.swiper-prev-btn' },
            breakpoints: {
                640: { slidesPerView: 2.2, spaceBetween: 20 },
                768: { slidesPerView: 3, spaceBetween: 24 },
                1024: { slidesPerView: 4, spaceBetween: 24 },
            },
        });
    </script>
@endsection