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
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 md:p-10 mb-8 relative">
        <h2 class="text-2xl font-extrabold italic text-black mb-6 tracking-tight">Panduan Kuis</h2>

        <p class="text-gray-800 text-base md:text-lg mb-6 leading-relaxed font-medium">
            Pada bagian ini kamu akan mengerjakan soal <span class="font-black">pilihan ganda</span> untuk menguji pemahaman kamu.
        </p>

        <div class="mb-10">
            <p class="text-gray-800 text-base md:text-lg font-medium mb-3">Ketentuan:</p>
            <ul class="list-disc pl-6 space-y-2 text-gray-800 font-medium text-base md:text-lg">
                <li>Pilih salah satu jawaban dengan benar.</li>
                <li>Setiap jawaban benar akan menambah skor kamu.</li>
                <li>Perhatikan waktu pengerjaan yang tersedia.</li>
                <li>Kerjakan soal secara mandiri dan jujur.</li>
                <li>Klik tombol <span class="font-black">"Kerjakan"</span> untuk memulai kuis.</li>
                <li>Jika kamu telah mengerjakan semua klik tombol <span class="font-black">"Kirim"</span></li>
            </ul>
        </div>

        <div class="flex justify-end">
            @if ($isCompleted)
                <button wire:click="startQuiz"
                    class="bg-[#93D333] text-white px-8 py-2.5 rounded-lg font-bold shadow-md transition">
                    Dikerjakan
                </button>
            @else
                <button wire:click="startQuiz"
                    class="bg-[#FF5A5F] text-white px-8 py-2.5 rounded-lg font-bold shadow-md transition">
                    Kerjakan
                </button>
            @endif
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Waktu Selesai -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 flex justify-between items-center h-28">
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
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
        </div>

        <!-- Nilai Tertinggi di Kelas -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 flex justify-between items-center h-28">
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
