<x-layouts>
    <x-slot:heading>Admin Login</x-slot>

    <div class="flex items-center justify-center h-screen bg-gray-100 p-4">
        <form method="POST" action="{{ route('admin.login.submit') }}" class="bg-white p-6 sm:p-8 rounded-2xl shadow-md w-full max-w-md">
            @csrf

            <h2 class="text-2xl font-bold mb-4 text-center">Admin Login</h2>
            <p class="text-sm text-gray-500 mb-6 text-center">Enter the admin password to access dashboard</p>

            <!-- Password Field -->
            <input type="password" name="password" placeholder="Password"
                class="w-full border px-3 py-2 rounded mb-3 focus:ring-2 focus:ring-black focus:outline-none text-sm sm:text-base" required>

            @error('password')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            @if(session('error'))
                <p class="text-red-500 text-sm mb-2">{{ session('error') }}</p>
            @endif

            <button type="submit" 
                class="w-full bg-black text-white py-2 rounded hover:bg-gray-800 transition mt-2">
                Login
            </button>
        </form>
    </div>
</x-layouts>