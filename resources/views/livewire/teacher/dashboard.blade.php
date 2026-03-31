<div class="p-4 md:p-8 h-full max-w-7xl mx-auto flex flex-col gap-6">

    <!-- Top Banner -->
    <div
        class="bg-[#94C4F0] rounded-xl flex flex-col md:flex-row items-center p-6 md:p-8 shadow-sm gap-6 text-center md:text-left">
        <!-- Avatar Placeholder -->
        <div
            class="w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 bg-gray-200 rounded-full flex-shrink-0 flex items-center justify-center overflow-hidden border-4 border-white/50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                class="w-16 h-16 sm:w-20 sm:h-20">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </div>

        <div class="flex flex-col gap-2 w-full md:w-auto items-center md:items-start">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black italic text-gray-900 tracking-wide">Selamat Datang
                Teacher</h1>
            <p class="text-gray-800 text-sm md:text-base mb-2">Tujuan dan Materi Pembelajaran IPAS</p>
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <button
                    class="bg-white hover:bg-gray-50 text-gray-900 font-bold px-4 md:px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 shadow-sm transition-colors w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 17.25c1.74 0 3.336.473 4.75 1.282V4.533ZM12.75 18.532c1.414-.809 3.01-1.282 4.75-1.282 1.652 0 3.197.481 4.5 1.325a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v13.999Z" />
                    </svg>
                    <span class="italic text-lg">Bahan</span>
                </button>
                <button
                    class="bg-white hover:bg-gray-50 text-gray-900 font-bold px-4 md:px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 shadow-sm transition-colors w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span class="italic text-lg">Tujuan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Middle Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
        <!-- Left gray empty box -->
        <div class="bg-[#d4d4d4] rounded-xl shadow-sm min-h-[350px] w-full">
            <!-- Empty content box as seen in picture -->
        </div>

        <!-- Right Best Student Leaderboard -->
        <div class="w-full">
            <!-- Murid Terbaik -->
            <div class="bg-[#2B73CA] rounded-xl p-6 shadow-sm flex flex-col h-full bg-opacity-95 text-white">
                <h3 class="text-white font-bold text-xl mb-1 tracking-wide">Murid Terbaik</h3>
                <p class="text-[#A2C7F1] text-xs mb-5">Murid dengan nilai dan pengerjaan terbaik</p>

                <div class="flex flex-col gap-4">
                    <!-- User 1 -->
                    <div class="flex items-center gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-[#F4C522] flex items-center justify-center text-[#966C02] text-xs font-bold">
                            1</div>
                        <div class="w-10 h-10 rounded-full bg-blue-300 overflow-hidden shrink-0 border border-blue-200">
                            <img src="https://i.pravatar.cc/100?img=1" class="w-full h-full object-cover"
                                alt="User">
                        </div>
                        <span class="text-white font-semibold text-sm flex-1">Alex John</span>
                        <div class="flex items-center gap-1 text-[#FFE345] font-bold">
                            <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-5 h-5 object-contain"
                                alt="Medal">
                            <span class="text-sm">950</span>
                        </div>
                    </div>

                    <!-- User 2 -->
                    <div class="flex items-center gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-[#D4D9DF] flex items-center justify-center text-[#68707B] text-xs font-bold">
                            2</div>
                        <div class="w-10 h-10 rounded-full bg-blue-300 overflow-hidden shrink-0 border border-blue-200">
                            <img src="https://i.pravatar.cc/100?img=5" class="w-full h-full object-cover"
                                alt="User">
                        </div>
                        <span class="text-white font-semibold text-sm flex-1">Emma Watson</span>
                        <div class="flex items-center gap-1 text-[#FFE345] font-bold">
                            <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-5 h-5 object-contain"
                                alt="Medal">
                            <span class="text-sm">920</span>
                        </div>
                    </div>

                    <!-- User 3 -->
                    <div class="flex items-center gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-[#CD7F32] flex items-center justify-center text-[#6A3906] text-xs font-bold">
                            3</div>
                        <div class="w-10 h-10 rounded-full bg-blue-300 overflow-hidden shrink-0 border border-blue-200">
                            <img src="https://i.pravatar.cc/100?img=8" class="w-full h-full object-cover"
                                alt="User">
                        </div>
                        <span class="text-white font-semibold text-sm flex-1">Michael Clark</span>
                        <div class="flex items-center gap-1 text-[#FFE345] font-bold">
                            <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-5 h-5 object-contain"
                                alt="Medal">
                            <span class="text-sm">980</span>
                        </div>
                    </div>

                    <!-- User 4 -->
                    <div class="flex items-center gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-[#203144] flex items-center justify-center text-gray-300 text-xs font-bold">
                            4</div>
                        <div class="w-10 h-10 rounded-full bg-blue-300 overflow-hidden shrink-0 border border-blue-200">
                            <img src="https://i.pravatar.cc/100?img=9" class="w-full h-full object-cover"
                                alt="User">
                        </div>
                        <span class="text-white font-semibold text-sm flex-1">Sophia Green</span>
                        <div class="flex items-center gap-1 text-[#FFE345] font-bold">
                            <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-5 h-5 object-contain"
                                alt="Medal">
                            <span class="text-sm">890</span>
                        </div>
                    </div>

                    <!-- User 5 -->
                    <div class="flex items-center gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-[#203144] flex items-center justify-center text-gray-300 text-xs font-bold">
                            5</div>
                        <div class="w-10 h-10 rounded-full bg-blue-300 overflow-hidden shrink-0 border border-blue-200">
                            <img src="https://i.pravatar.cc/100?img=10" class="w-full h-full object-cover"
                                alt="User">
                        </div>
                        <span class="text-white font-semibold text-sm flex-1">Lucia Wilde</span>
                        <div class="flex items-center gap-1 text-[#FFE345] font-bold">
                            <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-5 h-5 object-contain"
                                alt="Medal">
                            <span class="text-sm">870</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Kuis Stats -->
    <div class="bg-[#2B73CA] rounded-xl p-6 shadow-sm">
        <h3 class="text-white font-bold text-center text-xl mb-4 tracking-wide uppercase">KUIS</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Stat 1 -->
            <div class="bg-white rounded-xl py-3 px-4 flex items-center justify-between shadow-sm">
                <div class="flex flex-col">
                    <p class="text-gray-900 font-bold text-[10px] md:text-sm">Rata-Rata Waktu</p>
                    <p class="text-2xl md:text-3xl font-black mt-1">12:45</p>
                </div>
                <div
                    class="w-8 h-8 rounded-full border border-[#99CB3A] text-[#99CB3A] flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white rounded-xl py-3 px-4 flex items-center justify-between shadow-sm">
                <div class="flex flex-col">
                    <p class="text-gray-900 font-bold text-[10px] md:text-sm">Rata-Rata Nilai</p>
                    <p class="text-2xl md:text-3xl font-black mt-1">78.5%</p>
                </div>
                <div
                    class="w-8 h-8 rounded-full border border-blue-500 text-blue-500 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white rounded-xl py-3 px-4 flex items-center justify-between shadow-sm">
                <div class="flex flex-col">
                    <p class="text-gray-900 font-bold text-[10px] md:text-sm">Nilai Terendah</p>
                    <p class="text-2xl md:text-3xl font-black mt-1">80%</p>
                </div>
                <div
                    class="w-8 h-8 rounded-full border border-orange-500 text-orange-500 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25C7.004 12 7.5 12.504 7.5 13.125v6.75C7.5 20.496 7.004 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white rounded-xl py-3 px-4 flex items-center justify-between shadow-sm">
                <div class="flex flex-col">
                    <p class="text-gray-900 font-bold text-[10px] md:text-sm">Nilai Tertinggi</p>
                    <p class="text-2xl md:text-3xl font-black mt-1">95%</p>
                </div>
                <div
                    class="w-8 h-8 rounded-full border border-orange-500 text-orange-500 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25C7.004 12 7.5 12.504 7.5 13.125v6.75C7.5 20.496 7.004 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

</div>
