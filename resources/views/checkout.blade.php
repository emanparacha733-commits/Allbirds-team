<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Allbirds</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9f9f9; }
    </style>
</head>
<body>

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
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
    </div>
</div>
@endif

<!-- Main Checkout Content - ALWAYS shows the form -->
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- LEFT: Checkout Form -->
        <div class="order-2 lg:order-1">

            <!-- Express Checkout -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-600 mb-4 text-center">Express checkout</h3>
                <div class="grid grid-cols-2 gap-3">
                    <button class="bg-[#5a31f4] text-white py-4 rounded flex items-center justify-center font-semibold hover:bg-[#4a21d4] transition">
                        <span>shop pay</span>
                    </button>
                    <button class="bg-[#ffc439] text-black py-4 rounded flex items-center justify-center font-semibold hover:bg-[#edb329] transition">
                        PayPal
                    </button>
                </div>
                <div class="flex items-center gap-3 my-4">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-gray-400 text-sm">OR</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>
            </div>

            <!-- Contact -->
            <div class="mb-6 bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xl font-semibold">Contact</h2>
                    <a href="#" class="text-sm text-gray-600 hover:text-black">Sign in</a>
                </div>
                <input type="email" placeholder="Email"
                    class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                <label class="flex items-center mt-3 text-sm">
                    <input type="checkbox" class="mr-2 w-4 h-4" checked>
                    <span>Email me with news and offers</span>
                </label>
            </div>

            <!-- Delivery -->
            <div class="mb-6 bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold mb-4">Delivery</h2>

                <div class="mb-4">
                    <select class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                        <option>United States</option>
                    </select>
                    <div class="text-xs text-gray-500 mt-1">Country/Region</div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input type="text" placeholder="First name"
                        class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                    <input type="text" placeholder="Last name"
                        class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="mb-4">
                    <input type="text" placeholder="Company (optional)"
                        class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="mb-4">
                    <input type="text" placeholder="Address"
                        class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <input type="text" placeholder="City"
                        class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                    <select class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                        <option>State</option>
                    </select>
                    <input type="text" placeholder="ZIP code"
                        class="border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <div class="mb-4">
                    <input type="tel" placeholder="Phone"
                        class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <label class="flex items-center text-sm">
                    <input type="checkbox" class="mr-2 w-4 h-4">
                    <span>Save this information for next time</span>
                </label>
            </div>

            <!-- Payment -->
            <div class="mb-6 bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold mb-4">Payment</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Card number</label>
                        <input type="text" placeholder="1234 1234 1234 1234"
                            class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Expiration date (MM / YY)</label>
                            <input type="text" placeholder="MM / YY"
                                class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Security code</label>
                            <input type="text" placeholder="CVV"
                                class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Name on card</label>
                        <input type="text" placeholder="Full name"
                            class="w-full border border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                    <label class="flex items-center text-sm">
                        <input type="checkbox" class="mr-2 w-4 h-4" checked>
                        <span>Use shipping address as billing address</span>
                    </label>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-2">Other payment methods</p>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 border border-gray-300 rounded text-sm hover:bg-gray-50">Shop Pay</button>
                        <button class="px-4 py-2 border border-gray-300 rounded text-sm hover:bg-gray-50">PayPal</button>
                        <button class="px-4 py-2 border border-gray-300 rounded text-sm hover:bg-gray-50">Afterpay</button>
                    </div>
                </div>

                <div class="mt-4 flex gap-2 text-xs text-gray-400">
                    <span>Visa</span><span>AMEX</span><span>Mastercard</span><span>+5</span>
                </div>
            </div>

            <!-- Place Order -->
            <form action="{{ route('checkout.place') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-black text-white py-4 rounded font-semibold hover:bg-gray-800 transition text-lg">
                    Place Order
                </button>
            </form>
        </div>

        <!-- RIGHT: Order Summary -->
        <div class="order-1 lg:order-2">
            <div class="bg-white rounded-lg p-6 shadow-sm sticky top-6">
                <h2 class="text-xl font-semibold mb-6">
                    Order Summary
                    <span class="text-sm font-normal text-gray-500 ml-2">({{ $cartCount }} item{{ $cartCount !== 1 ? 's' : '' }})</span>
                </h2>

                <!-- Cart Items -->
                @if(empty($cart))
                    <p class="text-gray-400 text-sm text-center py-6">No items in cart yet.</p>
                @else
                <div class="space-y-4 mb-6 pb-6 border-b border-gray-200 max-h-96 overflow-y-auto">
                    @foreach($cart as $id => $item)
                    <div class="flex gap-4">
                        <div class="relative flex-shrink-0">
                            <div class="w-20 h-20 bg-gray-100 rounded overflow-hidden">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.src='https://via.placeholder.com/80x80?text=IMG'">
                            </div>
                            <span class="absolute -top-2 -right-2 w-6 h-6 bg-gray-700 text-white text-xs flex items-center justify-center rounded-full">
                                {{ $item['quantity'] }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-sm mb-1">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-500">Size: {{ $item['size'] }}</p>
                            <p class="text-sm text-gray-500">${{ number_format($item['price'], 2) }} each</p>

                            <!-- Qty controls -->
                            <div class="flex items-center gap-2 mt-2">
                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                    <button type="submit"
                                        class="w-7 h-7 border border-gray-300 rounded text-gray-600 hover:bg-gray-100 text-lg leading-none flex items-center justify-center">−</button>
                                </form>
                                <span class="w-6 text-center text-sm font-semibold">{{ $item['quantity'] }}</span>
                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                    <button type="submit"
                                        class="w-7 h-7 border border-gray-300 rounded text-gray-600 hover:bg-gray-100 text-lg leading-none flex items-center justify-center">+</button>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST" class="inline ml-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 underline">Remove</button>
                                </form>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-sm">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- You Might Also Like -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <h3 class="font-semibold mb-4 text-sm">You might also like</h3>
                    <div class="flex justify-between items-center">
                        <div class="flex gap-3">
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-400">Bag</div>
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
                            <button type="submit"
                                class="bg-black text-white px-4 py-2 rounded text-sm font-semibold hover:bg-gray-800">Add</button>
                        </form>
                    </div>
                </div>

                <!-- Discount Code -->
                <div class="mb-6">
                    <div class="flex gap-2">
                        <input type="text" placeholder="Discount code or gift card"
                            class="flex-1 border border-gray-300 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
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
                    @if($subtotal >= 150)
                    <div class="flex justify-between text-sm text-green-600 font-semibold">
                        <span>🎉 30% Discount</span>
                        <span>-${{ number_format($subtotal * 0.3, 2) }}</span>
                    </div>
                    @endif
                </div>

                <!-- Grand Total -->
                <div class="flex justify-between items-center text-lg font-semibold">
                    <span>Total</span>
                    <div class="text-right">
                        <span class="text-sm text-gray-500 mr-1">USD</span>
                        <span>${{ number_format($subtotal >= 150 ? $subtotal * 0.7 : $subtotal, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>