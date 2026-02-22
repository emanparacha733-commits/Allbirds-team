<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - Allbirds</title>
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

<!-- Success Content -->
<div class="max-w-2xl mx-auto px-6 py-20 text-center">

    <!-- Checkmark Icon -->
    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
    </div>

    <h1 class="text-3xl font-bold mb-3">Order Confirmed! 🎉</h1>
    <p class="text-gray-500 text-lg mb-8">
        Thank you for your purchase. Your order has been placed successfully and is being processed.
    </p>

    <div class="bg-white rounded-lg p-6 shadow-sm mb-8 text-left">
        <h2 class="font-semibold text-lg mb-4 border-b pb-3">What happens next?</h2>
        <ul class="space-y-3 text-sm text-gray-600">
            <li class="flex items-start gap-3">
                <span class="text-green-500 font-bold mt-0.5">✓</span>
                <span>You'll receive a confirmation email shortly.</span>
            </li>
            <li class="flex items-start gap-3">
                <span class="text-green-500 font-bold mt-0.5">✓</span>
                <span>Your order will be packed and shipped within 1–2 business days.</span>
            </li>
            <li class="flex items-start gap-3">
                <span class="text-green-500 font-bold mt-0.5">✓</span>
                <span>You'll get a tracking number once your order ships.</span>
            </li>
        </ul>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('home') }}"
            class="bg-black text-white px-8 py-3 rounded font-semibold hover:bg-gray-800 transition">
            Continue Shopping
        </a>
        <a href="{{ route('men.shoes') }}"
            class="border border-black text-black px-8 py-3 rounded font-semibold hover:bg-gray-50 transition">
            Shop Men's
        </a>
    </div>
</div>

</body>
</html>