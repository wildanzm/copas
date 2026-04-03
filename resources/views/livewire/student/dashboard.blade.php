<div class="p-4 md:p-8 h-full max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">

    <!-- Left Column (Learning Map) -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Ayo Belajar Banner -->
        <div
            class="bg-[#A4CFF0] rounded-xl flex flex-col sm:flex-row items-start sm:items-center justify-between px-6 md:px-8 py-5 shadow-sm gap-4 sm:gap-0">
            <h2 class="text-xl md:text-2xl font-black italic text-gray-900 tracking-wide text-center w-full sm:w-auto">
                Ayo Belajar</h2>
            <button
                class="bg-white hover:bg-gray-50 text-gray-900 font-bold px-4 md:px-6 py-2 rounded-xl flex items-center justify-center gap-2 shadow-sm transition-colors w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                <span class="italic text-lg">Tujuan</span>
            </button>
        </div>

        <!-- Section Title -->
        <div class="flex items-center justify-center my-8">
            <div class="h-px bg-gray-400 w-16"></div>
            <span class="px-4 text-gray-800 font-semibold tracking-wide">Permasalahan Lingkungan</span>
            <div class="h-px bg-gray-400 w-16"></div>
        </div>

        <!-- Path Map (Simplified Design) -->
        <div class="relative flex flex-col items-center flex-1 mt-6 pb-20">
            <!-- Nodes -->
            <div class="relative z-10 w-full max-w-sm sm:max-w-md h-[550px] sm:h-[650px]">

                <!-- Node 1 (Top rightish) -->
                <a href="{{ route('student.play-room', ['nodeId' => 1]) }}" wire:navigate
                    class="absolute top-[0%] left-[65%] sm:left-[60%] -translate-x-1/2 rounded-full shadow-lg flex items-center justify-center border-4 transition-transform
                    bg-[#1056A4] border-[#073666] hover:scale-110 w-[4.5rem] h-[4.5rem] sm:w-[5.5rem] sm:h-[5.5rem]">
                    <img src="{{ asset('assets/icons/learning/node-1.png') }}"
                        class="w-8 h-8 sm:w-10 sm:h-10 object-contain" alt="Node 1">
                </a>

                <!-- Node 2 (Middle Leftish) -->
                @if ($this->unlockedNode >= 2)
                    <a href="{{ route('student.play-room', ['nodeId' => 2]) }}" wire:navigate
                        class="absolute top-[22%] left-[35%] sm:left-[45%] -translate-x-1/2 w-[4.5rem] h-[4.5rem] sm:w-[5.5rem] sm:h-[5.5rem] rounded-full shadow-lg flex items-center justify-center border-4 transition-transform bg-[#1056A4] border-[#073666] hover:scale-110">
                        <img src="{{ asset('assets/icons/learning/node-2-4.png') }}"
                            class="w-8 h-8 sm:w-10 sm:h-10 object-contain" alt="Node 2">
                    </a>
                @else
                    <div
                        class="absolute top-[22%] left-[35%] sm:left-[45%] -translate-x-1/2 w-[4.5rem] h-[4.5rem] sm:w-[5.5rem] sm:h-[5.5rem] rounded-full shadow-lg flex items-center justify-center border-4 transition-transform bg-gray-400 border-gray-500 cursor-not-allowed opacity-80 mix-blend-luminosity">
                        <img src="{{ asset('assets/icons/learning/node-2-4.png') }}"
                            class="w-8 h-8 sm:w-10 sm:h-10 object-contain" alt="Node 2">
                    </div>
                @endif

                <!-- Node 3 (Middle Rightish) -->
                @if ($this->unlockedNode >= 3)
                    <a href="{{ route('student.play-room', ['nodeId' => 3]) }}" wire:navigate
                        class="absolute top-[44%] left-[20%] sm:left-[30%] -translate-x-1/2 w-[4.5rem] h-[4.5rem] sm:w-[5.5rem] sm:h-[5.5rem] rounded-full shadow-lg flex items-center justify-center border-4 transition-transform bg-[#1056A4] border-[#073666] hover:scale-110">
                        <img src="{{ asset('assets/icons/learning/node-3.png') }}"
                            class="w-8 h-8 sm:w-10 sm:h-10 object-contain" alt="Node 3">
                    </a>
                @else
                    <div
                        class="absolute top-[44%] left-[20%] sm:left-[30%] -translate-x-1/2 w-[4.5rem] h-[4.5rem] sm:w-[5.5rem] sm:h-[5.5rem] rounded-full shadow-lg flex items-center justify-center border-4 transition-transform bg-gray-400 border-gray-500 cursor-not-allowed opacity-80 mix-blend-luminosity">
                        <img src="{{ asset('assets/icons/learning/node-3.png') }}"
                            class="w-8 h-8 sm:w-10 sm:h-10 object-contain" alt="Node 3">
                    </div>
                @endif

                <!-- Node 4 (Bottom Leftish) -->
                @if ($this->unlockedNode >= 4)
                    <a href="{{ route('student.play-room', ['nodeId' => 4]) }}" wire:navigate
                        class="absolute top-[66%] left-[35%] sm:left-[45%] -translate-x-1/2 w-[4.5rem] h-[4.5rem] sm:w-[5.5rem] sm:h-[5.5rem] rounded-full shadow-lg flex items-center justify-center border-4 transition-transform bg-[#1056A4] border-[#073666] hover:scale-110">
                        <img src="{{ asset('assets/icons/learning/node-2-4.png') }}"
                            class="w-8 h-8 sm:w-10 sm:h-10 object-contain" alt="Node 4">
                    </a>
                @else
                    <div
                        class="absolute top-[66%] left-[35%] sm:left-[45%] -translate-x-1/2 w-[4.5rem] h-[4.5rem] sm:w-[5.5rem] sm:h-[5.5rem] rounded-full shadow-lg flex items-center justify-center border-4 transition-transform bg-gray-400 border-gray-500 cursor-not-allowed opacity-80 mix-blend-luminosity">
                        <img src="{{ asset('assets/icons/learning/node-2-4.png') }}"
                            class="w-8 h-8 sm:w-10 sm:h-10 object-contain" alt="Node 4">
                    </div>
                @endif

                <!-- Node 5 (Bottom center/rightish) -->
                @if ($this->unlockedNode >= 5)
                    <a href="{{ route('student.play-room', ['nodeId' => 5]) }}" wire:navigate
                        class="absolute top-[88%] left-[65%] sm:left-[60%] -translate-x-1/2 w-[5rem] h-[5rem] sm:w-[6rem] sm:h-[6rem] rounded-full shadow-lg flex items-center justify-center border-4 transition-transform bg-[#1056A4] border-[#073666] hover:scale-110">
                        <img src="{{ asset('assets/icons/learning/node-5.png') }}"
                            class="w-10 h-10 sm:w-12 sm:h-12 object-contain" alt="Node 5">
                    </a>
                @else
                    <div
                        class="absolute top-[88%] left-[65%] sm:left-[60%] -translate-x-1/2 w-[5rem] h-[5rem] sm:w-[6rem] sm:h-[6rem] rounded-full shadow-lg flex items-center justify-center border-4 transition-transform bg-gray-400 border-gray-500 cursor-not-allowed opacity-80 mix-blend-luminosity">
                        <img src="{{ asset('assets/icons/learning/node-5.png') }}"
                            class="w-10 h-10 sm:w-12 sm:h-12 object-contain" alt="Node 5">
                    </div>
                @endif
            </div>

        </div>
    </div>


    <!-- Right Column (Stats and Leaderboard) -->
    <div class="w-full lg:w-96 flex flex-col gap-4 relative z-20">

        <!-- Top Stats Row -->
        <div
            class="bg-[#2B73CA] rounded-xl flex items-center justify-between px-6 py-4 shadow-sm text-white font-bold text-xl h-[70px]">
            <div class="flex items-center gap-2 text-[#FFE345]">
                <!-- Medal Icon -->
                <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-7 h-7 object-contain" alt="Medal">
                <span>600</span>
            </div>

            <div class="flex items-center gap-2 text-[#FF5D5D]">
                <!-- Star Icon Placeholder -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                    <path fill-rule="evenodd"
                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-white italic">Level 15</span>
            </div>
        </div>

        <!-- Progres Belajar -->
        <div class="bg-[#2B73CA] rounded-xl p-5 shadow-sm">
            <h3 class="text-center text-white font-bold italic text-2xl mb-4 tracking-wide">Progres Belajar</h3>
            <div class="w-full bg-white rounded-full h-5 relative overflow-hidden flex items-center p-1">
                <div class="bg-[#99CB3A] h-full rounded-full transition-all duration-500"
                    style="width: {{ $this->progressPercentage }}%"></div>
            </div>
        </div>

        <!-- Murid Terbaik -->
        <div class="bg-[#2B73CA] rounded-xl p-6 shadow-sm flex flex-col h-fit pb-8">
            <h3 class="text-white font-bold text-xl mb-1 tracking-wide">Murid Terbaik</h3>
            <p class="text-[#A2C7F1] text-xs mb-5">Murid dengan nilai dan pengerjaan terbaik</p>

            <div class="flex flex-col gap-4">
                <!-- User 1 -->
                <div class="flex items-center gap-3">
                    <div
                        class="w-6 h-6 rounded-full bg-[#F4C522] flex items-center justify-center text-[#966C02] text-xs font-bold">
                        1</div>
                    <div class="w-10 h-10 rounded-full bg-blue-300 overflow-hidden shrink-0 border border-blue-200">
                        <img src="https://i.pravatar.cc/100?img=1" class="w-full h-full object-cover" alt="User">
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
                        <img src="https://i.pravatar.cc/100?img=5" class="w-full h-full object-cover" alt="User">
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
                        <img src="https://i.pravatar.cc/100?img=8" class="w-full h-full object-cover" alt="User">
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
                        <img src="https://i.pravatar.cc/100?img=9" class="w-full h-full object-cover" alt="User">
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
