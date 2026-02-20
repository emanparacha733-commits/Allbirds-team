<x-layouts.app>

<style>
    .thumb-active { border-color: black !important; }
</style>

<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- Breadcrumb --}}
    <nav class="text-xs text-gray-400 mb-6 uppercase tracking-widest">
        <a href="/" class="hover:text-black transition">Home</a>
        <span class="mx-2">/</span>
        @if($product->gender === 'women')
            <a href="{{ route('women.shoes') }}" class="hover:text-black transition">Women</a>
        @else
            <a href="{{ route('men.shoes') }}" class="hover:text-black transition">Men</a>
        @endif
        <span class="mx-2">/</span>
        <span class="text-black">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

        {{-- ═══════════════════════════════════════
             LEFT — Image Gallery
        ════════════════════════════════════════ --}}
        <div class="flex flex-col gap-3">

            {{-- Main Image --}}
            <img id="mainImage"
                 src="{{ $product->image_url }}"
                 alt="{{ $product->name }}"
                 class="w-full h-[580px] object-contain rounded-2xl bg-gray-50 border border-gray-100">

            {{-- Thumbnails: main + image_2 + image_3 --}}
            <div class="grid grid-cols-3 gap-2">

                {{-- Thumb 1 — main image --}}
                <img class="w-full h-[110px] object-contain rounded-xl cursor-pointer border-2 border-black bg-gray-50 thumb-active"
                     src="{{ $product->image_url }}"
                     alt="{{ $product->name }}"
                     onclick="setMain(this)">

                {{-- Thumb 2 --}}
                @if($product->image_2)
                    <img class="w-full h-[110px] object-contain rounded-xl cursor-pointer border-2 border-transparent hover:border-gray-400 bg-gray-50 transition"
                         src="{{ asset('storage/' . $product->image_2) }}"
                         alt="{{ $product->name }}"
                         onclick="setMain(this)">
                @else
                    <div class="w-full h-[110px] rounded-xl bg-gray-100 flex items-center justify-center text-xs text-gray-400">No image</div>
                @endif

                {{-- Thumb 3 --}}
                @if($product->image_3)
                    <img class="w-full h-[110px] object-contain rounded-xl cursor-pointer border-2 border-transparent hover:border-gray-400 bg-gray-50 transition"
                         src="{{ asset('storage/' . $product->image_3) }}"
                         alt="{{ $product->name }}"
                         onclick="setMain(this)">
                @else
                    <div class="w-full h-[110px] rounded-xl bg-gray-100 flex items-center justify-center text-xs text-gray-400">No image</div>
                @endif

            </div>

            {{-- Color Variant Images --}}
            @if(!empty($product->color_variants) && count($product->color_variants) > 0)
            <div class="mt-2">
                <p class="text-[10px] text-gray-400 mb-2 uppercase tracking-widest">More Colors</p>
                <div class="flex gap-3 flex-wrap">
                    @foreach($product->color_variants as $variant)
                        @if(!empty($variant['image']))
                        <div class="flex flex-col items-center gap-1 cursor-pointer"
                             onclick="setMainSrc('{{ asset('storage/' . $variant['image']) }}')">
                            <img src="{{ asset('storage/' . $variant['image']) }}"
                                 class="w-16 h-16 object-contain rounded-xl border-2 border-transparent hover:border-black transition bg-gray-50">
                            <div class="w-4 h-4 rounded-full border border-gray-300"
                                 style="background-color: {{ $variant['color_hex'] ?? '#000' }}"></div>
                            <span class="text-[10px] text-gray-500">{{ $variant['color_name'] ?? '' }}</span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- ═══════════════════════════════════════
             RIGHT — Product Details
        ════════════════════════════════════════ --}}
        <div class="flex flex-col gap-5">

            {{-- Name & Price --}}
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-black uppercase">{{ $product->name }}</h1>
                <p class="text-xl font-semibold text-black mt-1">${{ number_format($product->price, 2) }}</p>
            </div>

            {{-- Rating placeholder --}}
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <div class="flex text-yellow-400 text-base">★★★★★</div>
                <span>4.8 (124 reviews)</span>
            </div>

            {{-- Description --}}
            @if($product->description)
            <p class="text-sm text-gray-600 leading-relaxed">{{ $product->description }}</p>
            @endif

            <hr class="border-gray-200">

            {{-- Color --}}
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Color</p>
                <p class="text-sm font-medium mb-2" id="colorLabel">
                    @if(!empty($product->color_variants))
                        {{ $product->color_variants[0]['color_name'] ?? $product->color_name ?? '' }}
                    @else
                        {{ $product->color_name ?? '' }}
                    @endif
                </p>
                <div class="flex items-center gap-3 flex-wrap">
                    @if(!empty($product->color_variants))
                        @foreach($product->color_variants as $variant)
                        <div class="p-[3px] rounded-full border-2 border-black cursor-pointer hover:scale-110 transition"
                             onclick="selectColor('{{ $variant['color_name'] ?? '' }}', '{{ !empty($variant['image']) ? asset('storage/'.$variant['image']) : '' }}')"
                             title="{{ $variant['color_name'] ?? '' }}">
                            <div class="w-8 h-8 rounded-full border border-gray-200"
                                 style="background-color: {{ $variant['color_hex'] ?? '#000' }}"></div>
                        </div>
                        @endforeach
                    @elseif($product->color_hex)
                        <div class="p-[3px] rounded-full border-2 border-black">
                            <div class="w-8 h-8 rounded-full border border-gray-200"
                                 style="background-color: {{ $product->color_hex }}"></div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Size Selector --}}
            @if(!empty($product->sizes) && count($product->sizes) > 0)
            <div>
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-500">Size</p>
                    <a href="#" class="text-xs text-gray-400 underline hover:text-black transition">Size Guide</a>
                </div>
                <div class="flex flex-wrap gap-2" id="sizeGrid">
                    @foreach($product->sizes as $size)
                    <button type="button"
                            class="size-btn w-14 h-10 border border-gray-300 rounded-lg text-sm font-medium hover:border-black transition"
                            onclick="selectSize(this, '{{ $size }}')">
                        {{ $size }}
                    </button>
                    @endforeach
                </div>
                <input type="hidden" name="size" id="selectedSize" value="">
            </div>
            @endif

            {{-- Add to Cart --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" id="formSize" value="">
                <input type="hidden" name="color" id="formColor" value="{{ $product->color_name ?? '' }}">

                <button type="submit"
                        class="w-full bg-black text-white py-4 rounded-full text-sm font-bold uppercase tracking-widest hover:bg-gray-800 transition">
                    Add to Cart
                </button>
            </form>

            {{-- Features --}}
            <div class="grid grid-cols-3 gap-3 mt-2">
                <div class="flex flex-col items-center gap-1 text-center p-3 bg-gray-50 rounded-xl">
                    <span class="text-lg">🌿</span>
                    <span class="text-[10px] text-gray-500 font-medium uppercase tracking-wide">Natural Materials</span>
                </div>
                <div class="flex flex-col items-center gap-1 text-center p-3 bg-gray-50 rounded-xl">
                    <span class="text-lg">♻️</span>
                    <span class="text-[10px] text-gray-500 font-medium uppercase tracking-wide">Carbon Neutral</span>
                </div>
                <div class="flex flex-col items-center gap-1 text-center p-3 bg-gray-50 rounded-xl">
                    <span class="text-lg">🚚</span>
                    <span class="text-[10px] text-gray-500 font-medium uppercase tracking-wide">Free Returns</span>
                </div>
            </div>

            {{-- Extra details --}}
            @if($product->material || $product->care_instructions)
            <div class="border border-gray-200 rounded-xl divide-y divide-gray-100 mt-2">
                @if($product->material)
                <details class="p-4 cursor-pointer">
                    <summary class="text-xs font-bold uppercase tracking-widest text-gray-700">Materials</summary>
                    <p class="mt-2 text-sm text-gray-500">{{ $product->material }}</p>
                </details>
                @endif
                @if($product->care_instructions)
                <details class="p-4 cursor-pointer">
                    <summary class="text-xs font-bold uppercase tracking-widest text-gray-700">Care</summary>
                    <p class="mt-2 text-sm text-gray-500">{{ $product->care_instructions }}</p>
                </details>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>

<script>
    // ── Image Gallery ──────────────────────────────────────
    window.setMain = function(thumb) {
        document.getElementById('mainImage').src = thumb.src;
        document.querySelectorAll('[onclick^="setMain"]').forEach(t => {
            t.classList.remove('border-black', 'thumb-active');
            t.classList.add('border-transparent');
        });
        thumb.classList.add('border-black', 'thumb-active');
        thumb.classList.remove('border-transparent');
    };

    window.setMainSrc = function(src) {
        document.getElementById('mainImage').src = src;
    };

    // ── Color ──────────────────────────────────────────────
    window.selectColor = function(name, imgSrc) {
        document.getElementById('colorLabel').textContent = name;
        document.getElementById('formColor').value = name;
        if (imgSrc) setMainSrc(imgSrc);
    };

    // ── Size ───────────────────────────────────────────────
    window.selectSize = function(btn, size) {
        document.querySelectorAll('.size-btn').forEach(b => {
            b.classList.remove('bg-black', 'text-white', 'border-black');
            b.classList.add('border-gray-300');
        });
        btn.classList.add('bg-black', 'text-white', 'border-black');
        btn.classList.remove('border-gray-300');
        document.getElementById('formSize').value = size;
        document.getElementById('selectedSize').value = size;
    };
</script>

</x-layouts.app>