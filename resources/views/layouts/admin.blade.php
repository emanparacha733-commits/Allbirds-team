<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8F7F4] font-sans text-gray-900 min-h-screen">

<div class="flex min-h-screen">

    <!-- ── Sidebar ── -->
    <aside class="w-56 bg-white border-r border-gray-100 flex flex-col fixed top-0 left-0 h-full z-40 shadow-sm">

        <!-- Logo -->
        <div class="px-6 py-5 border-b border-gray-100">
            <span class="text-lg font-bold tracking-tight text-black">⬡ ADMIN</span>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
               {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-black' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
               {{ request()->routeIs('admin.products*') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-black' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Products
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
               {{ request()->routeIs('admin.orders*') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-black' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Orders
            </a>

            <a href="{{ route('admin.customers.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
               {{ request()->routeIs('admin.customers*') ? 'bg-black text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-black' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Customers
            </a>

        </nav>

        <!-- Bottom: View Store -->
        <div class="px-3 py-4 border-t border-gray-100">
            <a href="{{ url('/') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-500 hover:bg-gray-100 hover:text-black transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Store
            </a>
        </div>

    </aside>

    <!-- ── Main Content ── -->
    <div class="flex-1 ml-56 flex flex-col min-h-screen">

        <!-- Top Bar -->
        <header class="bg-white border-b border-gray-100 px-8 py-4 flex items-center justify-between sticky top-0 z-30">
            <h1 class="text-sm font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-3">
                @if(session('success'))
                <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">{{ session('success') }}</span>
                @endif
                <div class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-xs font-bold">A</div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 px-8 py-6">
            @yield('content')
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>