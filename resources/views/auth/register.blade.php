<x-layouts>
    <x-slot:heading>
        Register
    </x-slot:heading>

    <!-- Background overlay -->
  <div class="fixed inset-0 bg-white flex items-center justify-center z-50 p-4">

    <!-- Form container -->
    <div class="bg-white shadow-2xl rounded-2xl p-6 sm:p-8 w-full max-w-md mx-auto">

        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <img src='/images/logo.png' alt="logo" class="w-48 sm:w-[240px]">
        </div>

        <!-- Heading -->
        <h4 class="text-xl sm:text-2xl font-bold text-black text-center">Sign in</h4>
        <p class="text-sm text-gray-500 mt-1 text-center">Sign in or create an account</p>

       <form method="POST" action="{{ route('register') }}" autocomplete="off">
    @csrf

    <!-- Top Button: Continue with Shop (direct login) -->
    <a href="{{ route('signin') }}"
       class="flex justify-center items-center text-white text-base sm:text-lg font-bold w-full h-12 sm:h-14 px-4 py-3 mt-5 border rounded-lg bg-[#5433EB] hover:bg-[#4326C9] transition duration-300 cursor-pointer text-center">
        Continue with Shop
    </a>

    <!-- OR Divider -->
    <div class="flex items-center mt-4">
        <div class="flex-1 border-t border-gray-300"></div>
        <p class="px-2 sm:px-4 text-gray-500 text-xs sm:text-sm">or</p>
        <div class="flex-1 border-t border-gray-300"></div>
    </div>

    <!-- Email Input -->
    <div class="mt-4 sm:mt-6">
        <input
            type="email"
            name="email"
            required
            placeholder="Email"
            class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-black focus:outline-none text-sm sm:text-base"
        />

        @error('email')
            <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
        @enderror

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-3 sm:px-4 py-2 rounded mb-4 mt-2 text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Bottom Button: Continue (requires email) -->
    <button
        type="submit"
        class="flex justify-center items-center text-white font-bold w-full h-12 sm:h-14 px-4 py-3 mt-5 border rounded-lg bg-gray-900 hover:bg-white hover:text-black hover:border-black transition duration-300 cursoPr-pointer text-sm sm:text-base">
        Continue
    </button>
</form>
    </div>
</div>
</x-layouts>
