@extends('layouts.app')

@section('content')
<div class="bg-[#f5f2ed] min-h-screen pb-12">
    <div class="text-center py-16 px-4">
        <h1 class="text-4xl font-serif text-gray-800 mb-4">Men's {{ ucfirst($category) }}</h1>
        <p class="max-w-2xl mx-auto text-gray-600 text-sm leading-relaxed">
            Crafted from soft, airy, natural materials like organic cotton and our breathable Tree Knit, these tees offer exceptional comfort.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-6 mb-10">
        <div class="bg-[#e9e4db]/80 rounded-full px-8 py-3 flex items-center justify-between shadow-sm backdrop-blur-sm border border-gray-200">
            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-gray-700">
                <span class="p-1 border border-gray-400 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </span>
                FILTER <span class="font-normal normal-case text-gray-500">({{ $products->count() }} products)</span>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="flex bg-white/50 rounded-full p-1 border border-gray-300">
                    <button class="bg-black text-white px-6 py-1 rounded-full text-[10px] font-bold uppercase">Men</button>
                    <button class="px-6 py-1 text-[10px] font-bold uppercase text-gray-500 hover:text-black">Women</button>
                </div>
                <div class="relative flex items-center gap-1 border-l border-gray-400 pl-6">
                    <select class="bg-transparent text-[11px] font-bold uppercase appearance-none outline-none cursor-pointer pr-4">
                        <option>Featured</option>
                        <option>Price: Low to High</option>
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 absolute right-0 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-12">
        @forelse($products as $product)
        <div class="group cursor-pointer">
            <div class="aspect-[4/5] overflow-hidden bg-white rounded-sm mb-4">
                <img src="{{ asset('images/' . $product->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $product->name }}">
            </div>
            
            <div class="space-y-1">
                <h3 class="text-[12px] font-bold uppercase tracking-wider text-gray-900">{{ $product->name }}</h3>
                <p class="text-[12px] text-gray-500">{{ $product->color_name }}</p>
                
                <div class="pt-4 flex items-center justify-between">
                    <div class="flex gap-1.5">
                        @foreach($product->colors as $color)
                        <button class="w-5 h-5 rounded-full border border-gray-200 p-[1px] ring-offset-1 hover:ring-1 hover:ring-black transition-all">
                            <div class="w-full h-full rounded-full" style="background-color: {{ $color->hex }}"></div>
                        </button>
                        @endforeach
                    </div>
                    <div class="text-[12px] font-bold">
                        @if($product->on_sale)
                            <span class="text-red-700">${{ $product->sale_price }}</span>
                            <span class="text-gray-400 line-through ml-1">${{ $product->price }}</span>
                        @else
                            ${{ $product->price }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="col-span-full text-center text-gray-500 py-20">No products found in this category.</p>
        @endforelse
    </div>
</div>

<div class="fixed bottom-6 right-6">
    <button class="bg-[#1d1d1d] text-white px-5 py-3 rounded-md text-xs font-bold shadow-xl hover:bg-black transition-colors">
        Chat
    </button>
</div>
@endsection