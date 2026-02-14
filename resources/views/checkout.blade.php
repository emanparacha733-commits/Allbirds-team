<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Allbirds</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

<!-- Top Announcement Bar -->
<div class="bg-[#2b2b2b] text-white text-center py-2 text-sm">
    <span>Shop New Arrivals. </span>
    <a href="{{ route('men.index') }}" class="underline hover:no-underline">Shop Men</a>
    <span> | </span>
    <a href="{{ route('women.index') }}" class="underline hover:no-underline">Shop Women</a>
</div>

<!-- Header -->
<header class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo-seo.jpeg') }}" alt="allbirds" class="h-12">
        </a>
    </div>
</header>

<!-- Main Checkout Content -->
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Left Column - Checkout Form -->
        <div class="order-2 lg:order-1">
            <!-- Express Checkout -->
            <div class="mb-8">
                <h3 class="text-gray-600 mb-4 text-center">Express checkout</h3>
                <div class="grid grid-cols-2 gap-3">
                    <button class="bg-[#5a31f4] text-white py-4 rounded flex items-center justify-center font-semibold hover:bg-[#4a21d4] transition">
                        <span class="text-xl">shop</span>
                    </button>
                    <button class="bg-[#ffc439] text-black py-4 rounded flex items-center justify-center font-semibold hover:bg-[#edb329] transition">
                        <svg class="h-6" viewBox="0 0 100 32" fill="#003087">
                            <path d="M12 4.917v18.17c0 1.106-.897 2.003-2.003 2.003H6.003A2.003 2.003 0 0 1 4 23.087V4.917c0-1.106.897-2.003 2.003-2.003h3.994A2.003 2.003 0 0 1 12 4.917zM38.986 8.94c-2.864 0-4.842 1.385-4.842 3.39 0 1.682 1.277 2.738 3.608 3.057l1.078.145c1.24.167 1.83.516 1.83 1.08 0 .758-.768 1.193-2.16 1.193-1.435 0-2.365-.464-2.448-1.494h-2.932c.057 2.17 1.93 3.535 5.365 3.535 3.1 0 5.165-1.48 5.165-3.708 0-1.77-1.32-2.796-3.707-3.115l-1.05-.145c-1.305-.174-1.83-.494-1.83-1.037 0-.69.69-1.122 1.787-1.122 1.234 0 2.024.464 2.164 1.407h2.775c-.126-2.024-1.887-3.186-4.803-3.186zm13.934.29h-3.086l-3.173 9.71h2.917l.59-1.917h3.622l.59 1.917h3.016zm-2.604 6.12l1.193-3.868 1.193 3.868h-2.386zm14.488-6.12h-2.604l-3.115 6.976V9.23h-2.917v9.71h2.917v-2.546l1.078-2.33 2.387 4.876h3.173l-3.722-6.69zm7.095 9.71c2.864 0 4.842-1.385 4.842-3.39 0-1.682-1.277-2.738-3.608-3.057l-1.078-.145c-1.24-.167-1.83-.516-1.83-1.08 0-.758.768-1.193 2.16-1.193 1.435 0 2.365.464 2.448 1.494h2.932c-.057-2.17-1.93-3.535-5.365-3.535-3.1 0-5.165 1.48-5.165 3.708 0 1.77 1.32 2.796 3.707 3.115l1.05.145c1.305.174 1.83.494 1.83 1.037 0 .69-.69 1.122-1.787 1.122-1.234 0-2.024-.464-2.164-1.407h-2.775c.126 2.024 1.887 3.186 4.803 3.186z"/>
                        </svg>
                    </button>
                </div>
                <div class="text-center text-gray-500 my-4">OR</div>
            </div>

            <!-- Contact Section -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xl font-semibold">Contact</h2>
                    <a href="#" class="text-sm text-gray-600 hover:text-black">Sign in</a>
                </div>
                <input 
                    type="email" 
                    placeholder="Email" 
                    class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black"
                >
                <label class="flex items-center mt-3 text-sm">
                    <input type="checkbox" class="mr-2 w-4 h-4" checked>
                    <span>Email me with news and offers</span>
                </label>
            </div>

            <!-- Delivery Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-3">Delivery</h2>
                
                <div class="mb-4">
                    <select class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                        <option>United States</option>
                    </select>
                    <div class="text-xs text-gray-500 mt-1">Country/Region</div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input 
                        type="text" 
                        placeholder="First name" 
                        class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black"
                    >
                    <input 
                        type="text" 
                        placeholder="Last name" 
                        class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black"
                    >
                </div>

                <div class="mb-4">
                    <input 
                        type="text" 
                        placeholder="Company (optional)" 
                        class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black"
                    >
                </div>

                <div class="mb-4 relative">
                    <input 
                        type="text" 
                        placeholder="Address" 
                        class="w-full border border-gray-300 rounded px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-black"
                    >
                    <svg class="w-5 h-5 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <input 
                        type="text" 
                        placeholder="City" 
                        class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black"
                    >
                    <select class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                        <option>State</option>
                    </select>
                    <input 
                        type="text" 
                        placeholder="ZIP code" 
                        class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black"
                    >
                </div>

                <div class="mb-4">
                    <input 
                        type="tel" 
                        placeholder="Phone" 
                        class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black"
                    >
                </div>

                <label class="flex items-center text-sm">
                    <input type="checkbox" class="mr-2 w-4 h-4">
                    <span>Save this information for next time</span>
                </label>
            </div>

            <!-- Continue Button -->
            <button class="w-full bg-[#5a5a5a] text-white py-4 rounded font-semibold hover:bg-black transition">
                Continue to shipping
            </button>
        </div>

        <!-- Right Column - Order Summary -->
        <div class="order-1 lg:order-2 bg-white rounded-lg p-6 h-fit sticky top-6">
            <h2 class="text-xl font-semibold mb-6">Order Summary</h2>

            <!-- Cart Item -->
            <div class="flex gap-4 mb-6 pb-6 border-b border-gray-200">
                <div class="relative">
                    <div class="w-20 h-20 bg-gray-100 rounded">
                        <img src="{{ asset('images/product-placeholder.jpg') }}" alt="Product" class="w-full h-full object-cover rounded">
                    </div>
                    <span class="absolute -top-2 -right-2 w-6 h-6 bg-gray-700 text-white text-xs flex items-center justify-center rounded-full">1</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-sm mb-1">Men's Tree Runner NZ - Burnt Olive (Burnt Olive Sole)</h3>
                    <p class="text-sm text-gray-600">9</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold">$100.00</p>
                </div>
            </div>

            <!-- You Might Also Like -->
            <div class="mb-6 pb-6 border-b border-gray-200">
                <h3 class="font-semibold mb-4">You might also like</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-3">
                            <div class="w-16 h-16 bg-gray-100 rounded">
                                <img src="{{ asset('images/bag-placeholder.jpg') }}" alt="Belt Bag" class="w-full h-full object-cover rounded">
                            </div>
                            <div>
                                <p class="font-medium text-sm">Recycled Belt Bag - True Black</p>
                                <p class="text-xs text-gray-500">One Size</p>
                                <p class="font-semibold text-sm">$35.00</p>
                            </div>
                        </div>
                        <button class="bg-black text-white px-6 py-2 rounded text-sm font-semibold hover:bg-gray-800">Add</button>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex gap-3">
                            <div class="w-16 h-16 bg-gray-100 rounded">
                                <img src="{{ asset('images/shoe-bag-placeholder.jpg') }}" alt="Shoe Bag" class="w-full h-full object-cover rounded">
                            </div>
                            <div>
                                <p class="font-medium text-sm">Recycled Shoe Bag - True Black</p>
                                <p class="text-xs text-gray-500">One Size</p>
                                <p class="font-semibold text-sm">$20.00</p>
                            </div>
                        </div>
                        <button class="bg-black text-white px-6 py-2 rounded text-sm font-semibold hover:bg-gray-800">Add</button>
                    </div>
                </div>
            </div>

            <!-- Discount Code -->
            <div class="mb-6">
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        placeholder="Discount code or gift card" 
                        class="flex-1 border border-gray-300 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black"
                    >
                    <button class="bg-gray-200 text-gray-700 px-6 py-3 rounded text-sm font-semibold hover:bg-gray-300">
                        Apply
                    </button>
                </div>
            </div>

            <!-- Totals -->
            <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                <div class="flex justify-between text-sm">
                    <span>Subtotal</span>
                    <span>$100.00</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span>Shipping</span>
                    <span class="text-gray-500">Enter shipping address</span>
                </div>
            </div>

            <!-- Grand Total -->
            <div class="flex justify-between items-center text-lg font-semibold">
                <span>Total</span>
                <div class="text-right">
                    <span class="text-sm text-gray-500 mr-2">USD</span>
                    <span>$100.00</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chat Button -->
<div class="fixed bottom-6 right-6 z-50">
    <button class="bg-black text-white px-6 py-3 rounded-full font-semibold text-sm shadow-lg hover:bg-gray-800 transition">
        Chat
    </button>
</div>

</body>
</html>