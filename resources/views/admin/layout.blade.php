<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @include('admin.header')
    <div class="flex">
        @include('admin.partials.sidebar', ['sidebarToggle' => false, 'selected' => Route::currentRouteName()])
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
    @include('admin.footer')
    <script src="@vite('resources/js/app.js')"></script>
</body>
</html>
