<div class="px-6 py-8 md:px-12 md:py-10 max-w-5xl mx-auto">

    <!-- Header (Level and XP Badge floating top right) -->
    <div class="flex justify-end mb-10">
        <div
            class="bg-[#2D74DB] rounded-lg shadow whitespace-nowrap flex items-center text-white px-4 py-2 font-bold gap-6">
            <div class="flex items-center gap-2">
                <img src="{{ asset('assets/icons/etc/medal.png') }}" class="h-6 w-6 object-contain" alt="XP Medal">
                <span class="text-xl">{{ $xp }}</span>
            </div>

            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF5A5F]" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="text-xl italic">Level {{ $level }}</span>
            </div>
        </div>
    </div>

    <!-- Main Panduan Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8 mb-8 relative">
        <h2 class="text-3xl font-extrabold italic text-black mb-4 tracking-tight">Panduan</h2>

        <p class="text-gray-800 text-lg mb-8 leading-relaxed font-medium">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
            anim id est laborum.
        </p>

        <div class="flex justify-end">
            @if ($isCompleted)
                <button disabled
                    class="bg-gray-400 text-white px-8 py-2.5 rounded-lg font-bold shadow-md opacity-80 cursor-not-allowed">
                    Dikerjakan
                </button>
            @else
                <button wire:click="startQuiz"
                    class="bg-[#FF5A5F] text-white px-8 py-2.5 rounded-lg font-bold shadow-md hover:bg-red-500 transition">
                    Kerjakan
                </button>
            @endif
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Waktu Selesai -->
        <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 flex justify-between items-center">
            <div>
                <div class="text-xs font-bold text-black mb-1">Waktu Selesai</div>
                <div class="text-3xl font-extrabold">{{ $finishedTime }}</div>
            </div>
            <div
                class="border border-[#2BAb4C] text-[#2BAb4C] rounded-full p-2 h-10 w-10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008z" />
                </svg>
            </div>
        </div>

        <!-- Nilai Kamu -->
        <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 flex justify-between items-center">
            <div>
                <div class="text-xs font-bold text-black mb-1">Nilai Kamu</div>
                <div class="text-3xl font-extrabold">{{ $myScore }}</div>
            </div>
            <div
                class="border border-[#4A85D1] text-[#4A85D1] rounded-full p-2 h-10 w-10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0z" />
                </svg>
            </div>
        </div>

        <!-- Nilai Tertinggi di Kelas -->
        <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 flex justify-between items-center">
            <div>
                <div class="text-xs font-bold text-black mb-1">Nilai Tertinggi di Kelas</div>
                <div class="text-3xl font-extrabold">{{ $highestScore }}</div>
            </div>
            <div
                class="border border-[#E07914] text-[#E07914] rounded-full p-2 h-10 w-10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125z" />
                </svg>
            </div>
        </div>
    </div>

</div>
