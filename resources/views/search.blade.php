@extends('layouts.app')

@section('content')
<div class="bg-[#f4f1ec] min-h-screen">
    <!-- Search Section -->
    <div class="bg-[#f4f1ec] py-16">
        <div class="max-w-3xl mx-auto px-6">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $query ?? '' }}"
                    placeholder="What are you looking for?" 
                    class="w-full bg-transparent border-b-2 border-gray-400 px-0 py-4 text-xl text-gray-600 placeholder-gray-500 focus:outline-none focus:border-black transition"
                >
                <button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-7xl mx-auto px-6 pb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Product 1 -->
            <a href="{{ route('women.shoes') }}" class="group">
                <div class="bg-white rounded-2xl overflow-hidden hover:shadow-xl transition">
                    <div class="relative">
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-[#b8a991] text-white text-xs font-bold px-3 py-1 rounded-full uppercase">Bestseller</span>
                        </div>
                        <div class="aspect-square bg-[#f5f5f5] flex items-center justify-center p-8">
                            <img src="{{ asset('images/product-placeholder.jpg') }}" alt="Product" class="w-full h-full object-contain">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm uppercase tracking-wide mb-1">Women's Tree Breezer</h3>
                        <p class="text-gray-600 text-sm mb-4">Navy Night</p>
                        <div class="flex items-center justify-between">
                            <div class="flex gap-1.5 items-center">
                                <span class="w-5 h-5 rounded-full bg-[#2c3e50] border-2 border-black"></span>
                                <span class="w-5 h-5 rounded-full bg-gray-400"></span>
                                <span class="w-5 h-5 rounded-full bg-gray-800"></span>
                                <span class="text-xs text-gray-600 font-semibold">+1</span>
                            </div>
                            <span class="font-semibold">$105</span>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Add 7 more products here following the same pattern -->
            
        </div>
    </div>
</div>

<!-- Chat Button -->
<div class="fixed bottom-6 right-6 z-50">
    <button class="bg-black text-white px-6 py-3 rounded-full font-semibold text-sm shadow-lg hover:bg-gray-800 transition">
        Chat
    </button>
</div>
@endsection