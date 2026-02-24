@extends('layouts.app')

@section('content')

@php
    // Load all homepage settings from DB
    $s = \App\Models\HomeSection::allAsArray();

    // Helpers with fallbacks
    $heroImage      = $s['hero']['image']      ?? 'images/hero.jpeg';
    $heroTagline    = $s['hero']['tagline']    ?? 'Made From Trees';
    $heroHeading    = $s['hero']['heading']    ?? 'Wildly Comfortable.<br>Super Natural.';
    $heroCollection = $s['hero']['collection'] ?? 'All New Dasher NZ Collection';

    $s2Cards = [
        ['key'=>'s2_card_1','default_img'=>'images/new arival.jpeg','default_label'=>'New Arrivals','default_link'=>route('men.shoes')],
        ['key'=>'s2_card_2','default_img'=>'images/men.jpeg',       'default_label'=>'Mens',        'default_link'=>route('men.shoes')],
        ['key'=>'s2_card_3','default_img'=>'images/woman.jpeg',     'default_label'=>'Womens',      'default_link'=>route('women.shoes')],
        ['key'=>'s2_card_4','default_img'=>'images/best seller.jpeg','default_label'=>'Bestsellers', 'default_link'=>route('men.shoes')],
    ];

    $s4HeaderName = $s['s4_header']['name'] ?? 'Cruiser Slip On Canvas';
    $s4HeaderSub  = $s['s4_header']['sub']  ?? 'Blizzard (Blizzard Sole) • $90';

    $s4Cards = [
        ['key'=>'s4_card_1','default_img'=>'images/section4.webp',    'default_title'=>'The Perfect Valentine'],
        ['key'=>'s4_card_2','default_img'=>'images/section4two.webp', 'default_title'=>'Varsity Collection'],
        ['key'=>'s4_card_3','default_img'=>'images/section4three.webp','default_title'=>'Dasher NZ Collection'],
    ];

    $s6Cards = [
        ['key'=>'s6_card_1','default_title'=>'Wear All Day Comfort',        'default_text'=>'Lightweight, bouncy, and wildly comfortable, Allbirds shoes make any outing feel effortless.'],
        ['key'=>'s6_card_2','default_title'=>'Sustainability In Every Step', 'default_text'=>"From materials to transport, we're working to reduce our carbon footprint to near zero."],
        ['key'=>'s6_card_3','default_title'=>'Materials From The Earth',     'default_text'=>'We replace petroleum-based synthetics with natural alternatives like wool and tree fiber.'],
    ];
@endphp

    {{-- HERO --}}
    <section class="mt-6 mb-12"
     style="background: #ECE9E2; padding: 0; margin-left: 10px; margin-right: 10px;">
        <div class="relative rounded-[2.5rem] overflow-hidden h-[85vh] shadow-2xl bg-gray-100">
            
            <img
                src="{{ asset($heroImage) }}"
                class="absolute inset-0 w-full h-full object-cover"
                alt="Hero"
            >
            <div class="absolute inset-0 bg-black/10"></div>

            <div class="absolute top-1/2 left-12 -translate-y-1/2 text-white flex flex-col items-center">
                <p class="font-serif italic text-2xl mb-2 drop-shadow-md">{{ $heroTagline }}</p>
                <div class="w-16 h-[1px] bg-white/70"></div>
            </div>

            <div class="absolute bottom-16 right-12 text-white text-right z-10">
                <p class="text-[11px] uppercase tracking-[0.3em] font-black mb-4 opacity-90 drop-shadow-md">
                    {{ $heroCollection }}
                </p>
                <h1 class="text-5xl md:text-7xl font-bold leading-[1.05] mb-10 drop-shadow-lg">
                    {!! nl2br(e($heroHeading)) !!}
                </h1>
                <div class="flex gap-4 justify-end">
                    <a href="{{ route('men.shoes') }}" class="btn-hero inline-block text-center" style="width:160px;height:44px;display:inline-flex;align-items:center;justify-content:center;box-sizing:border-box;">Shop Men</a>
                    <a href="{{ route('women.shoes') }}" class="btn-hero inline-block text-center" style="width:160px;height:44px;display:inline-flex;align-items:center;justify-content:center;box-sizing:border-box;">Shop Women</a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2 — 4 cards --}}
    <section id="section-2" class="bg-[#f5f2ed] py-16"
     style="background: #ECE9E2; padding-left: 10px; padding-right: 10px;">
        <div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($s2Cards as $card)
                @php
                    $img   = !empty($s[$card['key']]['image']) ? asset($s[$card['key']]['image']) : asset($card['default_img']);
                    $label = $s[$card['key']]['label'] ?? $card['default_label'];
                    $link  = $s[$card['key']]['link']  ?? $card['default_link'];
                @endphp
                <div class="relative group h-[550px] w-full overflow-hidden rounded-[40px] transition-all duration-700 ease-in-out hover:rounded-[275px] cursor-pointer">
                    <img src="{{ $img }}" alt="{{ $label }}"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/45 transition-all duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                        <span class="text-white text-[13px] sm:text-[15px] font-bold uppercase tracking-[0.25em] drop-shadow-lg mb-6 z-10">
                            {{ $label }}
                        </span>
                        <a href="{{ $link }}"
                           class="px-8 py-3 min-w-[160px] border border-white text-white text-xs font-bold uppercase tracking-[0.2em] rounded-full backdrop-blur-sm opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 hover:bg-white hover:text-black transition-all duration-500 ease-out text-center">
                            Shop Now
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SECTION 3 — scrolling shoes (static/generated, not editable) --}}
    <section class="relative overflow-hidden select-none" id="section-3"
             style="background: #ECE9E2; height: 680px; margin: 0; padding: 0;">
        <div class="absolute top-0 left-0 right-0 flex justify-center z-20 pointer-events-none" style="padding-top: 40px;">
            <a href="{{ route('men.shoes') }}" style="pointer-events: all; text-decoration: none;">
                <h1 style="font-family:'Courier New',monospace;font-size:20px;font-weight:700;letter-spacing:0.45em;text-transform:uppercase;color:#1a1a1a;margin:0;padding-bottom:3px;border-bottom:1px solid #1a1a1a;display:inline-block;">NEW ARRIVALS</h1>
            </a>
        </div>
        <div class="absolute left-0 right-0 bottom-0 flex items-center justify-center pointer-events-none z-0" style="height:65%;">
            <div style="width:44%;height:70%;background-image:radial-gradient(circle,#b0a898 1.3px,transparent 1.3px);background-size:22px 22px;opacity:0.45;"></div>
        </div>
        <div class="absolute z-10" id="s3-track-wrapper" style="cursor:none;overflow:hidden;top:100px;left:0;right:0;bottom:0;">
            <div id="s3-track" style="display:flex;align-items:flex-end;height:100%;position:absolute;bottom:0;left:0;"></div>
        </div>
        <div id="s3-cursor" style="position:fixed;top:0;left:0;width:120px;height:120px;border-radius:50%;border:1.5px solid #1a1a1a;background:transparent;display:flex;align-items:center;justify-content:center;pointer-events:none;z-index:9999;opacity:0;transform:translate(-50%,-50%);transition:opacity 0.25s ease;">
            <span id="s3-cursor-arrow" style="font-size:22px;color:#1a1a1a;line-height:1;">→</span>
        </div>
    </section>
    <style>#s3-track-wrapper, #s3-track-wrapper * { cursor: none !important; }</style>
    <script>
    (function () {
        const wrap=document.getElementById('s3-track-wrapper'),track=document.getElementById('s3-track'),cursor=document.getElementById('s3-cursor'),arrowEl=document.getElementById('s3-cursor-arrow');
        if(!wrap||!track||!cursor)return;
        const images=['{{ asset("images/whitemain.webp") }}','{{ asset("images/gray1.webp") }}','{{ asset("images/red1.webp") }}','{{ asset("images/green1.png") }}','{{ asset("images/black1.webp") }}'];
        const SLIDE_VW=42;
        function slideW(){return window.innerWidth*SLIDE_VW/100;}
        function setW(){return slideW()*images.length;}
        function buildSlides(){track.innerHTML='';[...images,...images,...images].forEach(src=>{const div=document.createElement('div');div.className='s3-slide';div.style.cssText=`flex-shrink:0;width:${SLIDE_VW}vw;height:100%;position:relative;`;const img=document.createElement('img');img.src=src;img.draggable=false;img.style.cssText='position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:90%;height:300%;object-fit:contain;object-position:bottom center;filter:drop-shadow(0 20px 40px rgba(0,0,0,0.14));pointer-events:none;display:block;';div.appendChild(img);track.appendChild(div);});}
        buildSlides();
        let pos=0,vel=0,isDragging=false,dragStartX=0,dragStartPos=0,lastMouseX=0;
        function init(){const sw=setW(),slide=slideW();pos=-(sw)+(wrap.offsetWidth/2)-(slide/2);track.style.transform=`translateX(${pos}px)`;}
        window.addEventListener('load',init);window.addEventListener('resize',()=>{buildSlides();init();});init();
        function wrapPos(){const sw=setW();if(pos>-(sw*0.5)+wrap.offsetWidth){pos-=sw;track.style.transform=`translateX(${pos}px)`;}if(pos<-(sw*1.5)){pos+=sw;track.style.transform=`translateX(${pos}px)`;}}
        function tick(){if(!isDragging){vel*=0.95;if(Math.abs(vel)>0.2){pos+=vel;track.style.transform=`translateX(${pos}px)`;wrapPos();}}requestAnimationFrame(tick);}tick();
        wrap.addEventListener('mouseenter',()=>cursor.style.opacity='1');wrap.addEventListener('mouseleave',()=>{cursor.style.opacity='0';if(isDragging)isDragging=false;});
        wrap.addEventListener('mousemove',(e)=>{cursor.style.left=e.clientX+'px';cursor.style.top=e.clientY+'px';arrowEl.textContent=e.clientX<wrap.getBoundingClientRect().left+wrap.offsetWidth/2?'←':'→';if(isDragging){vel=e.pageX-lastMouseX;lastMouseX=e.pageX;pos=dragStartPos+(e.pageX-dragStartX);track.style.transform=`translateX(${pos}px)`;wrapPos();}});
        wrap.addEventListener('mousedown',(e)=>{isDragging=true;dragStartX=e.pageX;dragStartPos=pos;lastMouseX=e.pageX;vel=0;});window.addEventListener('mouseup',()=>{if(isDragging)isDragging=false;});
        wrap.addEventListener('click',(e)=>{if(Math.abs(e.pageX-dragStartX)>8)return;const goRight=e.clientX>wrap.getBoundingClientRect().left+wrap.offsetWidth/2;vel=goRight?-slideW()*0.06:slideW()*0.06;});
        let tStartX=0,tStartPos=0,tLastX=0;
        wrap.addEventListener('touchstart',(e)=>{isDragging=true;tStartX=e.touches[0].pageX;tStartPos=pos;tLastX=e.touches[0].pageX;vel=0;},{passive:true});
        wrap.addEventListener('touchmove',(e)=>{if(!isDragging)return;vel=e.touches[0].pageX-tLastX;tLastX=e.touches[0].pageX;pos=tStartPos+(e.touches[0].pageX-tStartX);track.style.transform=`translateX(${pos}px)`;wrapPos();},{passive:true});
        wrap.addEventListener('touchend',()=>{isDragging=false;});
    })();
    </script>

    {{-- SECTION 4 — 3-column grid --}}
    <section class="section-4" style="background:#ECE9E2;padding-left:20px;padding-right:20px;">
        <div class="header-content">
            <h1>{{ $s4HeaderName }}</h1>
            <p>{!! $s4HeaderSub !!}</p>
            <div class="button-group">
                <a href="{{ route('men.shoes') }}" class="btn">SHOP MEN</a>
                <a href="{{ route('women.shoes') }}" class="btn">SHOP WOMEN</a>
            </div>
        </div>
        <div class="s4-image-grid">
            @foreach($s4Cards as $card)
            @php
                $img       = !empty($s[$card['key']]['image'])      ? asset($s[$card['key']]['image'])      : asset($card['default_img']);
                $title     = $s[$card['key']]['title']     ?? $card['default_title'];
                $linkMen   = $s[$card['key']]['link_men']  ?? '/men/shoes';
                $linkWomen = $s[$card['key']]['link_women'] ?? '/women/shoes';
            @endphp
            <div class="s4-grid-card">
                <div class="s4-img-container">
                    <img src="{{ $img }}" alt="{{ $title }}">
                </div>
                <div class="s4-card-overlay">
                    <h2 class="s4-overlay-title">{{ $title }}</h2>
                    <div class="s4-card-buttons">
                        <a href="{{ $linkMen }}" class="s4-btn-outline">SHOP MEN</a>
                        <a href="{{ $linkWomen }}" class="s4-btn-outline">SHOP WOMEN</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <style>
        .btn-hero { min-width:160px;width:160px;height:44px;display:inline-flex;align-items:center;justify-content:center;padding:0;font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;border-radius:999px;text-decoration:none;box-sizing:border-box;white-space:nowrap; }
        .section-4 .btn { min-width:160px;width:160px;height:44px;display:inline-flex;align-items:center;justify-content:center;padding:0;font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;border-radius:999px;box-sizing:border-box;white-space:nowrap; }
        .s4-btn-outline { display:inline-flex;align-items:center;justify-content:center;width:160px;height:44px;padding:0;font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;border-radius:999px;text-decoration:none;box-sizing:border-box;white-space:nowrap;border:1.5px solid #fff;color:#fff;background:transparent;transition:background 0.25s,color 0.25s; }
        .s4-btn-outline:hover { background:#fff;color:#000; }
        .s4-image-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:24px;padding-bottom:50px; }
        .s4-grid-card { position:relative;overflow:hidden;border-radius:20px;height:800px; }
        .s4-img-container { width:100%;height:100%; }
        .s4-img-container img { width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.6s ease; }
        .s4-grid-card:hover .s4-img-container img { transform:scale(1.1); }
        .s4-card-overlay { position:absolute;inset:0;background:rgba(0,0,0,0);display:flex;flex-direction:column;align-items:center;justify-content:flex-end;padding-bottom:44px;transition:background 0.4s ease; }
        .s4-grid-card:hover .s4-card-overlay { background:rgba(0,0,0,0.32); }
        .s4-overlay-title { color:#fff;font-size:20px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;margin-bottom:20px;text-align:center; }
        .s4-card-buttons { display:flex;gap:14px; }
        @media (max-width:768px) { .s4-image-grid { grid-template-columns:1fr; } .s4-grid-card { height:480px; } }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- SECTION 5 — New Arrivals slider (static) --}}
    <section id="section-5" class="font-sans overflow-hidden"
     style="background:#ECE9E2;padding:40px 20px 16px 20px;">
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('men.shoes') }}" class="text-sm font-bold tracking-[0.2em] uppercase border-b-2 border-black pb-1 hover:text-gray-600 transition-colors">New Arrivals</a>
            <div class="flex gap-3">
                <button class="swiper-prev-btn w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center bg-white/50 hover:bg-white transition-all shadow-sm cursor-pointer">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button class="swiper-next-btn w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center bg-white/50 hover:bg-white transition-all shadow-sm cursor-pointer">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
        <div class="swiper newArrivalsSwiper">
            <div class="swiper-wrapper">
                @foreach(range(1,10) as $index)
                <div class="swiper-slide">
                    <a href="{{ route('men.shoes') }}" class="group block bg-white rounded-lg p-6 relative transition-shadow hover:shadow-md h-full">
                        <span class="absolute top-4 left-4 bg-[#e8e6e1] text-[10px] font-bold px-2 py-1 rounded uppercase tracking-tighter">New</span>
                        <div class="flex items-center justify-center mb-6" style="height:280px;">
                            <img src="{{ asset('images/' . $index . '.jpg') }}" alt="Shoe {{ $index }}" class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
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

    {{-- SECTION 6 — Info cards --}}
    <section id="section-6" class="font-sans"
     style="background:#ECE9E2;padding:12px 20px 40px 20px;">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($s6Cards as $card)
            @php
                $title = $s[$card['key']]['title'] ?? $card['default_title'];
                $text  = $s[$card['key']]['text']  ?? $card['default_text'];
            @endphp
            <div class="bg-white rounded-xl p-8 min-h-[280px] flex flex-col justify-start transition-shadow hover:shadow-sm">
                <h4 class="text-[11px] font-bold tracking-[0.2em] uppercase mb-6 text-gray-800">{{ $title }}</h4>
                <p class="text-[15px] leading-relaxed text-gray-900 font-medium">{{ $text }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.newArrivalsSwiper', {
            slidesPerView: 1.2, spaceBetween: 16, grabCursor: true,
            navigation: { nextEl: '.swiper-next-btn', prevEl: '.swiper-prev-btn' },
            breakpoints: { 640:{slidesPerView:2.2,spaceBetween:20}, 768:{slidesPerView:3,spaceBetween:24}, 1024:{slidesPerView:4,spaceBetween:24} },
        });
    </script>

@endsection