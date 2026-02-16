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
    <a href="{{ route('men.shoes') }}" class="underline hover:no-underline">Shop Men</a>
    <span> | </span>
    <a href="{{ route('women.shoes') }}" class="underline hover:no-underline">Shop Women</a>
</div>

<!-- Header -->
<header class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo-seo.jpeg') }}" alt="allbirds" class="h-12">
        </a>
    </div>
</header>

<!-- Success Message -->
@if(session('success'))
<div class="max-w-7xl mx-auto px-6 pt-4">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
</div>
@endif

<!-- Main Checkout Content -->
<div class="max-w-7xl mx-auto px-6 py-8">
    @if(empty($cart))
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <h2 class="text-2xl font-semibold mb-4">Your cart is empty</h2>
            <p class="text-gray-600 mb-6">Add some products to get started!</p>
            <a href="{{ route('men.shoes') }}" class="inline-block bg-black text-white px-8 py-3 rounded font-semibold hover:bg-gray-800">
                Shop Men's Shoes
            </a>
            <a href="{{ route('women.shoes') }}" class="inline-block bg-black text-white px-8 py-3 rounded font-semibold hover:bg-gray-800 ml-4">
                Shop Women's Shoes
            </a>
        </div>
    @else
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
                            PayPal
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

                <!-- Cart Items -->
                <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                    @foreach($cart as $id => $item)
                    <div class="flex gap-4">
                        <div class="relative">
                            <div class="w-20 h-20 bg-gray-100 rounded">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover rounded">
                            </div>
                            <span class="absolute -top-2 -right-2 w-6 h-6 bg-gray-700 text-white text-xs flex items-center justify-center rounded-full">
                                {{ $item['quantity'] }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-sm mb-1">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-600">Size: {{ $item['size'] }}</p>
                            
                            <!-- Quantity Controls -->
                            <div class="flex items-center gap-2 mt-2">
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <select name="quantity" onchange="this.form.submit()" class="text-sm border border-gray-300 rounded px-2 py-1">
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </form>
                                
                                <!-- Remove Button -->
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 underline">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    </div>
                    @endforeach
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
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="bag-001">
                                <input type="hidden" name="name" value="Recycled Belt Bag - True Black">
                                <input type="hidden" name="price" value="35">
                                <input type="hidden" name="size" value="One Size">
                                <input type="hidden" name="image" value="images/bag-placeholder.jpg">
                                <button type="submit" class="bg-black text-white px-6 py-2 rounded text-sm font-semibold hover:bg-gray-800">Add</button>
                            </form>
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
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="bag-002">
                                <input type="hidden" name="name" value="Recycled Shoe Bag - True Black">
                                <input type="hidden" name="price" value="20">
                                <input type="hidden" name="size" value="One Size">
                                <input type="hidden" name="image" value="images/shoe-bag-placeholder.jpg">
                                <button type="submit" class="bg-black text-white px-6 py-2 rounded text-sm font-semibold hover:bg-gray-800">Add</button>
                            </form>
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
                        <span>${{ number_format($subtotal, 2) }}</span>
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
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Chat Button -->
<div class="fixed bottom-6 right-6 z-50">
    <button class="bg-black text-white px-6 py-3 rounded-full font-semibold text-sm shadow-lg hover:bg-gray-800 transition">
        Chat
    </button>
</div>

</body>
</html>