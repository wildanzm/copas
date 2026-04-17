<div class="p-4 md:p-8 h-full max-w-7xl mx-auto flex flex-col lg:grid lg:grid-cols-12 gap-y-8 lg:gap-8">

    <!-- Ayo Belajar Banner -->
    <div
        class="order-1 lg:col-span-8 bg-[#A4CFF0] rounded-xl flex flex-col sm:flex-row items-start sm:items-center justify-between px-6 md:px-8 py-5 shadow-sm gap-4 sm:gap-0 relative z-30 w-full">
        <h2 class="text-xl md:text-2xl font-black italic text-gray-900 tracking-wide text-center w-full sm:w-auto">
            Ayo Belajar</h2>

        <div class="relative w-full sm:w-auto" x-data="{ showObjective: false }">
            <button @mouseenter="showObjective = true" @mouseleave="showObjective = false"
                @click="showObjective = !showObjective"
                class="bg-white hover:bg-gray-50 text-gray-900 font-bold px-4 md:px-6 py-2 rounded-xl flex items-center justify-center gap-2 shadow-sm transition-colors w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                <span class="italic text-lg">Tujuan</span>
            </button>

            <!-- Tooltip / Modal Box -->
            <div x-show="showObjective" x-transition.opacity style="display: none;"
                class="absolute top-full mt-2 sm:right-1/2 sm:translate-x-1/2 lg:right-0 lg:translate-x-0 w-[300px] sm:w-[450px] bg-[#FAF9F5] border border-gray-200 rounded-xl shadow-xl p-6 z-[100] text-gray-900">
                <h4 class="font-black text-sm mb-3 tracking-wide uppercase">Tujuan Pembelajaran</h4>
                <ol class="list-decimal pl-5 space-y-2 text-sm leading-relaxed font-medium">
                    <li>Menjelaskan permasalahan lingkungan yang ada dengan baik dan benar.</li>
                    <li>Menjelaskan penyebab terjadinya permasalahan lingkungan.</li>
                    <li>Menjelaskan dampak permasalahan lingkungan terhadap kehidupan manusia.</li>
                    <li>Memberikan solusi untuk mengatasi permasalahan lingkungan yang ada.</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Section Title -->
    <div class="order-3 lg:col-span-8 flex items-center justify-center my-2 lg:my-4 w-full">
        <div class="h-px bg-gray-400 w-16"></div>
        <span class="px-4 text-gray-800 font-semibold tracking-wide text-center">Permasalahan Lingkungan</span>
        <div class="h-px bg-gray-400 w-16"></div>
    </div>

    <!-- Path Map (Simplified Design) -->
    <div class="order-4 lg:col-span-8 relative flex flex-col items-center flex-1 pb-20 w-full mt-2">
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

    <!-- Right Column (Stats and Leaderboard) -->
    <div
        class="order-2 lg:col-span-4 lg:col-start-9 lg:row-span-4 flex flex-col gap-4 relative z-20 w-full mb-6 lg:mb-0">

        <!-- Top Stats Row -->
        <div
            class="bg-[#2B73CA] rounded-xl flex items-center justify-between px-6 py-4 shadow-sm text-white font-bold text-xl h-[70px]">
            <div class="flex items-center gap-2 text-[#FFE345]">
                <!-- Medal Icon -->
                <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-7 h-7 object-contain" alt="Medal">
                <span>{{ number_format($xp) }}</span>
            </div>

            <div class="flex items-center gap-2 text-[#FF5D5D]">
                <!-- Star Icon Placeholder -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                    <path fill-rule="evenodd"
                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-white italic">Level {{ $level }}</span>
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
                @foreach ($leaderboard as $index => $student)
                    <div class="flex items-center gap-3">
                        @php
                            $rankClass = match ($index + 1) {
                                1 => 'bg-[#F4C522] text-[#966C02]',
                                2 => 'bg-[#D4D9DF] text-[#68707B]',
                                3 => 'bg-[#CD7F32] text-[#6A3906]',
                                default => 'bg-[#203144] text-gray-300',
                            };
                        @endphp
                        <div
                            class="w-6 h-6 rounded-full {{ $rankClass }} flex items-center justify-center text-xs font-bold">
                            {{ $index + 1 }}
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-300 overflow-hidden shrink-0 border border-blue-200">
                            @if ($student->avatar)
                                <img src="{{ asset('storage/' . $student->avatar) }}"
                                    class="w-full h-full object-cover" alt="{{ $student->name }}">
                            @else
                                <img src="{{ asset('assets/icons/dashboard/profil.png') }}"
                                    class="w-full h-full object-contain p-1.5 bg-[#2B73CA]"
                                    alt="{{ $student->name }}">
                            @endif
                        </div>
                        <span class="text-white font-semibold text-sm flex-1">{{ $student->name }}</span>
                        <div class="flex items-center gap-1 text-[#FFE345] font-bold">
                            <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-5 h-5 object-contain"
                                alt="Medal">
                            <span class="text-sm">{{ number_format($student->total_xp ?? 0) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
