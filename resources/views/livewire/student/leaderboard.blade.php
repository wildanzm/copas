<div class="px-4 py-6 md:px-12 md:py-10 max-w-4xl mx-auto">
    <!-- Header Badge -->
    <div class="flex justify-end mb-20 md:mb-24">
        <div
            class="bg-[#2D74DB] rounded-lg shadow whitespace-nowrap flex items-center text-white px-3 py-1.5 md:px-4 md:py-2 font-bold gap-4 md:gap-6">
            <div class="flex items-center gap-1.5 md:gap-2">
                <img src="{{ asset('assets/icons/etc/medal.png') }}" class="h-5 w-5 md:h-6 md:w-6 object-contain" alt="XP Medal">
                <span class="text-lg md:text-xl">{{ $xp }}</span>
            </div>

            <div class="flex items-center gap-1.5 md:gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-[#FF5A5F]" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="text-lg md:text-xl italic">Level {{ $level }}</span>
            </div>
        </div>
    </div>

    <!-- Leaderboard Container -->
    <div class="relative mt-8">

        <!-- Floating Rank Box -->
        <div
            class="absolute -top-12 left-1/2 w-[85%] max-w-[320px] md:min-w-[320px] md:w-auto transform -translate-x-1/2 bg-[#6799D9] rounded-lg shadow-lg text-center py-3 px-4 md:py-4 md:px-8 z-10">
            <div class="text-white font-bold italic text-base md:text-xl drop-shadow-sm mb-0.5 md:mb-1">Kamu meraih peringkat</div>
            <div class="text-[#FFC806] font-black italic text-3xl md:text-4xl drop-shadow-md">#{{ $myRank }}</div>
        </div>

        <!-- Main Blue Box -->
        <div
            class="bg-[#2672D6] rounded-xl shadow-2xl pt-20 pb-8 px-4 sm:px-6 md:pt-24 md:pb-12 md:px-14 relative overflow-hidden ring-1 ring-blue-400/20">

            <div class="flex flex-col space-y-4 md:space-y-6">
                @foreach ($leaderboard as $index => $student)
                    @php
                        $rank = $index + 1;
                        $rankBgClass = match ($rank) {
                            1 => 'bg-[#FFC806] text-white',
                            2 => 'bg-[#C5CCD5] text-white',
                            3 => 'bg-[#D98748] text-white',
                            default => 'bg-[#313131] text-white',
                        };

                        $isFirst = $rank === 1;
                    @endphp

                    <div
                        class="flex items-center gap-3 sm:gap-4 md:gap-6 relative {{ $isFirst ? 'pb-4 md:pb-6 border-b border-[#5293E3] mb-1 md:mb-2' : '' }}">
                        <!-- Rank Circle -->
                        <div class="relative shrink-0 flex justify-center items-center w-8 md:w-12 pt-1">
                            <div
                                class="w-8 h-8 md:w-11 md:h-11 rounded-full {{ $rankBgClass }} flex items-center justify-center text-sm md:text-xl font-bold z-10 shadow-inner">
                                {{ $rank }}
                            </div>
                        </div>

                        <!-- Avatar -->
                        <div class="relative shrink-0">
                            @if ($isFirst)
                                <!-- Small Crown for #1 -->
                                <svg class="w-10 h-10 md:w-14 md:h-14 absolute -top-6 -left-3 md:-top-8 md:-left-5 text-[#FFD633] transform -rotate-[20deg] drop-shadow-lg z-20 pointer-events-none"
                                    viewBox="0 0 64 64" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 44h40l-6-24-10 14-8-18-8 18-10-14 2 24z" stroke="#000"
                                        stroke-width="2" stroke-linejoin="round" />
                                    <circle cx="6" cy="18" r="3" fill="#FFD633" stroke="#000"
                                        stroke-width="2" />
                                    <circle cx="32" cy="10" r="3" fill="#FFD633" stroke="#000"
                                        stroke-width="2" />
                                    <circle cx="58" cy="18" r="3" fill="#FFD633" stroke="#000"
                                        stroke-width="2" />
                                </svg>
                            @endif
                            <div
                                class="w-10 h-10 md:w-14 md:h-14 rounded-full overflow-hidden border-2 border-transparent bg-blue-300 shadow-xl relative z-10 flex items-center justify-center">
                                @if ($student->avatar)
                                    <img src="{{ asset('storage/' . $student->avatar) }}"
                                        class="w-full h-full object-cover" alt="{{ $student->name }}">
                                @else
                                    <img src="{{ asset('assets/icons/dashboard/profil.png') }}"
                                        class="w-full h-full object-contain p-1 md:p-1.5 bg-[#2B73CA]"
                                        alt="{{ $student->name }}">
                                @endif
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="flex-1 text-white font-bold text-base sm:text-lg md:text-2xl truncate min-w-0 tracking-wide pl-1 md:pl-2">
                            {{ $student->name }}
                        </div>

                        <!-- XP Points -->
                        <div class="flex items-center gap-1 md:gap-2 text-[#FFC806] font-bold shrink-0">
                            <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-5 h-5 md:w-6 md:h-6 object-contain"
                                alt="Medal">
                            <span class="text-base sm:text-lg md:text-2xl">{{ $student->total_xp ?? 0 }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
