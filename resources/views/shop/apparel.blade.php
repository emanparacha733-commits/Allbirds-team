@extends('layouts.app')

@section('content')
<div class="category-container">
  <div class="category-container bg-[#f8f7f5] min-h-screen">
    <nav class="py-4 px-6 text-xs text-gray-500">
        <a href="/" class="hover:underline">Home</a> / 
        <a href="/mens" class="hover:underline">Mens</a> / 
        <span class="font-medium text-black">Men's Socks</span>
    </nav>

    <div class="text-center max-w-2xl mx-auto py-10 px-4">
        <h1 class="text-3xl md:text-4xl font-semibold mb-4">Men's Socks</h1>
        <p class="text-gray-600 text-sm leading-relaxed">
            Our Trino™ Socks are made from the best materials nature has to offer, 
            like wool and trees. Pair them with Allbirds shoes for unbeatable 
            comfort that's even better together.
        </p>
    </div>

    <div class="sticky top-0 z-10 px-6 py-4 flex justify-between items-center bg-[#edece9] border-y border-gray-200 mb-8">
        <button class="flex items-center gap-2 font-medium uppercase text-xs tracking-widest">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            FILTER ({{ count($products) }} products)
        </button>

        <div class="flex border border-gray-300 rounded-full p-1 bg-white shadow-sm">
            <button class="px-6 py-1 bg-black text-white rounded-full text-xs font-bold uppercase">Men</button>
            <button class="px-6 py-1 text-gray-500 text-xs font-bold uppercase hover:bg-gray-100 rounded-full transition">Women</button>
        </div>

        <div class="relative group">
            <button class="flex items-center gap-4 bg-white border border-gray-300 rounded-full px-6 py-2 text-xs font-bold uppercase shadow-sm">
                Featured
                <span class="text-[10px]">▼</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-6 mb-20">
        @foreach($products as $product)
            <div class="group cursor-pointer">
                <div class="relative aspect-square bg-[#f1f1f1] rounded-lg overflow-hidden flex items-center justify-center p-8 transition-all hover:shadow-md">
                    @if($product->is_new)
                        <span class="absolute top-4 left-4 bg-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm">NEW</span>
                    @endif
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="object-contain w-full h-full transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="mt-4 pb-6">
                    <h4 class="text-sm font-bold border-b-2 border-transparent group-hover:border-black inline-block transition-all">{{ $product->name }}</h4>
                </div>
            </div>
        @endforeach
    </div>
</div>>

    <div class="product-grid">
        @foreach($products as $product)
            <div class="card">
                @if($product->is_new)
                    <span class="new-tag">NEW</span>
                @endif
                <div class="img-box">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
                <h4>{{ $product->name }}</h4>
            </div>
        @endforeach
    </div>

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
</div>
@endsection
