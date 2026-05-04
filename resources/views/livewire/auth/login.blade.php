<x-layouts::auth :title="__('Copas | Masuk Akun!')">
    <div class="flex flex-col gap-6 w-full">
        <x-auth-header title="Masuk Akun!" description="Selamat Datang Kembali Teman" />

        {{-- Validation errors and session status are handled globally via SweetAlert in the layout --}}

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
            @csrf

            <!-- Email Address / Username -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                    autocomplete="off" placeholder="Nama Pengguna"
                    class="block w-full pl-10 pr-3 py-3 border {{ $errors->has('login') || $errors->has('email') ? 'border-red-500' : 'border-gray-400' }} bg-transparent rounded-md text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FA8B43] focus:border-[#FA8B43] sm:text-lg font-medium">
            </div>
            @if ($errors->has('login') || $errors->has('email'))
                <p class="-mt-2 text-xs text-red-600">{{ $errors->first('login') ?: $errors->first('email') }}</p>
            @endif

            <!-- Password -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    placeholder="Kata Sandi"
                    class="block w-full pl-10 pr-3 py-3 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-400' }} bg-transparent rounded-md text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FA8B43] focus:border-[#FA8B43] sm:text-lg font-medium">
            </div>
            @error('password')
                <p class="-mt-2 text-xs text-red-600">{{ $message }}</p>
            @enderror

            @if (Route::has('password.request'))
                <div class="flex justify-end">
                    <a class="text-sm font-medium text-gray-800 hover:text-black hover:underline"
                        href="{{ route('password.request') }}" wire:navigate>
                        Lupa Password?
                    </a>
                </div>
            @endif

            <input type="checkbox" name="remember" id="remember" class="hidden" {{ old('remember') ? 'checked' : '' }}>

            <div class="mt-2 text-center w-full">
                <button type="submit"
                    class="w-full bg-[#FA8B43] hover:bg-[#E57A33] text-white font-semibold py-3 px-4 rounded-md transition duration-150 shadow-md sm:text-lg">
                    Masuk
                </button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-gray-700">
                <span>Belum punya akun?</span>
                <a href="{{ route('register') }}" class="font-bold hover:underline" wire:navigate>Daftar sekarang</a>
            </div>
        @endif
    </div>
</x-layouts::auth>
