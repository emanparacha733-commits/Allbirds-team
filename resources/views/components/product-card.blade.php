@props(['image', 'title', 'subtitle', 'price', 'link' => null])

@if($link)
<a href="{{ $link }}" class="relative group w-full block bg-white p-6 pt-10 h-[420px] rounded-2xl shadow-2xl cursor-pointer transition-all duration-300 ease-out hover:h-[520px] hover:-translate-y-2 hover:z-50 overflow-visible">
@else
<div class="relative z-50 group w-full block bg-white p-6 pt-10 h-[420px] rounded-2xl shadow-2xl cursor-pointer transition-all duration-300 ease-out hover:h-[520px] overflow-visible">
@endif

    <span class="absolute top-4 left-4 bg-orange-100 text-black text-xs px-3 py-1 rounded-full z-10">
        NEW
    </span>

    <img src="{{ $image }}" class="w-full h-48 object-cover rounded-xl" />

    <h4 class="mt-20 text-sm font-semibold text-black">{{ $title }}</h4>
    <p class="text-gray-500 text-sm">{{ $subtitle }}</p>
    <p class="text-black font-semibold">${{ $price }}</p>

    <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
        {{ $slot }}
    </div>

@if($link)
</a>
@else
</div>
@endif