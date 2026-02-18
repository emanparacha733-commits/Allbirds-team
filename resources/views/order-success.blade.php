<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Allbirds</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

<!-- Header -->
<header class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo-seo.jpeg') }}" alt="allbirds" class="h-12">
        </a>
    </div>
</header>

<div class="max-w-2xl mx-auto px-6 py-16 text-center">
    <div class="bg-white rounded-lg shadow-lg p-12">
        <div class="text-6xl mb-4">🎉</div>
        <h1 class="text-3xl font-bold mb-4">Congratulations!</h1>
        <p class="text-xl text-gray-600 mb-8">Your order has been placed successfully.</p>
        <p class="text-gray-500 mb-8">We've sent a confirmation email to your inbox.</p>
        <a href="{{ route('home') }}" class="inline-block bg-black text-white px-8 py-3 rounded font-semibold hover:bg-gray-800">
            Continue Shopping
        </a>
    </div>
</div>

</body>
</html>