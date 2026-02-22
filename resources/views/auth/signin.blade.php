<x-layouts>
    <x-slot:heading>
        Log In
    </x-slot>

    <div class="fixed inset-0 bg-white flex items-center justify-center z-50 p-4">

        <!-- Form container -->
        <div class="bg-white shadow-2xl rounded-2xl p-6 sm:p-8 w-full max-w-md mx-auto">

            <h4 class="text-xl sm:text-xl font-bold text-black text-center">Sign in to Shop</h4>
            <p class="text-sm text-gray-500 mt-1 text-center">or create an account</p>

            <form method="POST" action="{{ route('signin') }}" autocomplete="off">
                @csrf

                <!-- Email Input -->
                <div class="mt-4 sm:mt-6">
                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="Email"
                        class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-black focus:outline-none text-sm sm:text-base"
                        value="{{ old('email') }}"
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

                <!-- Continue Button -->
                <button
                    type="submit"
                    class="flex justify-center items-center text-white font-bold w-full h-12 sm:h-14 px-4 py-3 mt-5 border rounded-lg bg-[#5433EB] hover:bg-[#4326C9] transition duration-300 cursor-pointer text-sm sm:text-base">
                    Continue
                </button>

                <p class="text-gray-600 text-center mt-8 text-sm">
                    By continuing, you agree to <span class="underline">Shop’s terms</span>, 
                    <span class="underline">privacy policy</span>, and to sharing your name and email with Allbirds. 
                    See their <span class="underline">terms</span> and <span class="underline">privacy policy</span>
                </p>
            </form>
        </div>
    </div>
</x-layouts>