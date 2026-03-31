<x-layouts::auth :title="__('Copas | Buat Akun!')">
    <div class="flex flex-col w-full">
        <div class="mb-6">
            <h1 class="text-[28px] font-extrabold text-black mb-1">Buat Akun!</h1>
            <p class="text-black text-sm">Bergabung dan Mulai Mengatur Kelas</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
            @csrf

            <!-- Name -->
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    autocomplete="name" placeholder="Nama"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-500 bg-transparent rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF8A3D] focus:border-[#FF8A3D] text-sm">
            </div>

            <!-- Username -->
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="username" name="username" type="text" value="{{ old('username') }}" required
                    autocomplete="username" placeholder="Nama Pengguna"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-500 bg-transparent rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF8A3D] focus:border-[#FF8A3D] text-sm">
            </div>

            <!-- Email Address -->
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path
                            d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                        <path
                            d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                    </svg>
                </div>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    autocomplete="email" placeholder="E-Mail"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-500 bg-transparent rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF8A3D] focus:border-[#FF8A3D] text-sm">
            </div>

            <!-- Password & Confirmation -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        placeholder="Sandi"
                        class="block w-full pl-10 pr-4 py-3 border border-gray-500 bg-transparent rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF8A3D] focus:border-[#FF8A3D] text-sm">
                </div>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        autocomplete="new-password" placeholder="Konfirmasi Sandi"
                        class="block w-full pl-10 pr-4 py-3 border border-gray-500 bg-transparent rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF8A3D] focus:border-[#FF8A3D] text-sm">
                </div>
            </div>

            <!-- School -->
            <div class="relative w-full mb-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path
                            d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.94 49.94 0 0 0-9.902 3.912l-.003.002c-.874.494-1.926.494-2.798 0l-.003-.002a49.94 49.94 0 0 0-9.902-3.912.75.75 0 0 1-.231-1.337A60.65 60.65 0 0 1 11.7 2.805Z" />
                        <path
                            d="M13.06 15.473c-1.25.708-2.87.708-4.12 0a51.49 51.49 0 0 1-5.19-3.232v4.204c0 1.258 1.096 2.392 2.76 3.197 1.636.792 3.826 1.233 6.49 1.233s4.854-.441 6.49-1.233c1.664-.805 2.76-1.939 2.76-3.197v-4.204a51.49 51.49 0 0 1-5.19 3.232Z" />
                    </svg>
                </div>
                <input id="school" name="school" type="text" value="{{ old('school') }}" required
                    placeholder="Sekolah"
                    class="block w-full pl-10 pr-4 py-3 border border-gray-500 bg-transparent rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF8A3D] focus:border-[#FF8A3D] text-sm">
            </div>

            <!-- Terms & Conditions - Completely native and responsive -->
            <label class="relative flex items-center mb-2 cursor-pointer group w-fit">
                <input id="terms" name="terms" type="checkbox" required
                    class="peer w-5 h-5 appearance-none rounded border border-gray-400 bg-white checked:bg-[#FA8B43] checked:border-[#FA8B43] focus:ring-2 focus:ring-offset-1 focus:ring-[#FA8B43] focus:outline-none transition-all duration-200 cursor-pointer shrink-0">
                <div
                    class="absolute left-0 flex items-center justify-center w-5 h-5 pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="ml-3 block text-sm text-black select-none font-medium">
                    Saya setuju dengan syarat & ketentuan.
                </span>
            </label>

            <!-- Submit Button -->
            <div class="mt-2 w-full">
                <button type="submit"
                    class="w-full bg-[#FF8A3D] hover:bg-[#E57A33] text-white font-semibold py-3 px-4 rounded-lg transition duration-150 shadow-sm text-sm">
                    Daftar Akun
                </button>
            </div>

            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-gray-700">
                <span>Sudah Punya Akun?</span>
                <a href="{{ route('login') }}" class="font-bold hover:underline" wire:navigate>Masuk ke akun</a>
            </div>
        </form>
    </div>
</x-layouts::auth>
