@props(['image', 'title', 'subtitle', 'price', 'link' => null, 'isNew' => false, 'colors' => [], 'onSale' => false, 'salePrice' => null])

@if($link)
<a href="{{ $link }}" class="relative group w-full block bg-white rounded-2xl cursor-pointer transition-all duration-300 ease-out hover:-translate-y-2 hover:z-50 overflow-visible" style="font-family: 'Inter', system-ui, sans-serif; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
@else
<div class="relative group w-full block bg-white rounded-2xl cursor-pointer transition-all duration-300 ease-out hover:-translate-y-2 hover:z-50 overflow-visible" style="font-family: 'Inter', system-ui, sans-serif; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
@endif

    {{-- NEW badge --}}
    @if($isNew)
    <span class="absolute top-4 left-4 bg-[#f0ebe3] text-black text-xs px-3 py-1 rounded-full z-10 font-medium">
        NEW
    </span>
    @endif

    {{-- Image --}}
    <div class="w-full h-[331px]">
        <img src="{{ $image }}" class="w-full h-full object-contain" alt="{{ $title }}" />
    </div>

    {{-- Info --}}
    <div class="w-full h-[111px] p-4 flex flex-col justify-between">
        <div>
            <h4 class="text-[14px] font-bold text-black tracking-wide uppercase leading-tight">{{ $title }}</h4>
            <p class="text-gray-500 text-[14px]">{{ $subtitle }}</p>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-1.5 flex-wrap">
                @foreach(array_slice($colors, 0, 5) as $color)
                    <span class="w-5 h-5 rounded-full border-2 border-white ring-1 ring-gray-200 inline-block flex-shrink-0"
                          style="background-color: {{ $color }};"></span>
                @endforeach
                @if(count($colors) > 5)
                    <span class="text-xs text-gray-400 font-medium">+{{ count($colors) - 5 }}</span>
                @endif
            </div>
            <div class="text-right">
                @if($onSale && $salePrice)
                    <span class="text-red-500 font-semibold text-[14px]">${{ number_format($salePrice, 0) }}</span>
                    <span class="text-gray-400 line-through text-xs ml-1">${{ number_format($price, 0) }}</span>
                @else
                    <span class="text-black font-semibold text-[14px]">${{ number_format($price, 0) }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="absolute left-0 right-0 z-[999]
                invisible opacity-0
                group-hover:visible group-hover:opacity-100
                transition-opacity duration-300 ease-out"
         style="top: calc(100% - 20px);">

        {{-- Bridge covers the card's rounded bottom corners completely --}}
        <div style="height: 20px; background: white;"></div>

        {{-- Size content — shadow lives ONLY here, pointing downward --}}
        <div class="px-4 pb-5 bg-white rounded-b-2xl"
             style="box-shadow: 0 20px 40px -8px rgba(0,0,0,0.18), 10px 16px 30px -12px rgba(0,0,0,0.10), -10px 16px 30px -12px rgba(0,0,0,0.10);">
            <div class="grid grid-cols-3 gap-2">
                {{ $slot }}
            </div>
        </div>
    </div>

@if($link)
</a>
@else
</div>
@endif