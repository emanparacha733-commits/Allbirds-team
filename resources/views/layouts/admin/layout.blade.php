<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Dashboard</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
        <div class="px-6 py-4 text-lg font-bold text-black">
            Admin Panel
        </div>
        <nav class="flex-1 px-4 space-y-2">
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-100">
                Dashboard
            </a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-100">
                Products
            </a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-100">
                Orders
            </a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-100">
                Reports
            </a>
             <a href="{{ route('admin.email') }}" class="block py-2 px-4 rounded hover:bg-gray-100">
                Registered Users
            </a>

           
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Header -->
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800">@yield('title')</h1>
            <div class="flex items-center gap-4">
                <span class="text-gray-600">Admin</span>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Logout</button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

        
    </div>

</div>
</body>
</html>