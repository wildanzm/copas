<x-layouts::auth :title="__('Copas | Lupa Password!')">
    <div class="flex flex-col gap-6 w-full">
        <x-auth-header title="Lupa Password!" description="Silakan masukkan email Anda untuk mengatur ulang kata sandi" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
            @csrf

            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="email" name="email" type="email" required autofocus placeholder="email"
                    class="block w-full pl-10 pr-3 py-3 border border-gray-400 bg-transparent rounded-md text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FA8B43] focus:border-[#FA8B43] sm:text-lg font-medium"
                    data-test="email-password-reset-link-input">
            </div>

            <button type="submit"
                class="w-full bg-[#FA8B43] hover:bg-[#E57A33] text-white font-semibold py-3 px-4 rounded-md transition duration-150 shadow-md sm:text-lg"
                data-test="email-password-reset-link-button">
                Atur Ulang Kata Sandi
            </button>
        </form>

        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-gray-700">
            <span>Ingat password Anda?</span>
            <a href="{{ route('login') }}" class="font-bold hover:underline" wire:navigate>Kembali ke login</a>
        </div>
    </div>
</x-layouts::auth>
