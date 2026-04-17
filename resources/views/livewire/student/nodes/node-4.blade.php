<div class="min-h-screen flex flex-col font-sans" x-data="{
    playSuccessEffects() {
        let audio = new Audio('{{ asset('assets/sound/winners.mp3') }}');
        audio.play().catch(e => console.log('Audio play prevented:', e));

        if (typeof confetti === 'function') {
            confetti({
                particleCount: 150,
                spread: 120,
                origin: { y: 1 },
                startVelocity: 60,
                zIndex: 99999
            });
        }
    }
}">
    <!-- Header / Top Bar -->
    <div class="flex items-center py-6 w-full max-w-3xl mx-auto px-4 md:px-0 mb-6">
        <a href="{{ route('student.dashboard') }}"
            class="text-black font-bold hover:opacity-70 transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="black"
                class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
        <div class="flex-1 flex justify-center px-4">
            <div
                class="w-full max-w-2xl h-4 border border-gray-400 rounded-full bg-white relative overflow-hidden shadow-inner">
                <!-- Progress Bar: Node 4 -->
                <div class="h-full bg-[#99CB3A] w-[80%] transition-all duration-500 rounded-full"></div>
            </div>
        </div>
        <div class="w-8"></div>
    </div>

    <!-- Content Area -->
    <div class="max-w-3xl mx-auto w-full px-4 sm:px-6 pb-12 flex-1">
        <h1 class="text-center font-black text-xl md:text-2xl mb-8 text-gray-900 tracking-wide">Mengapa Terjadi dan Bagaimana Solusinya?</h1>

        <!-- Intro text & Character -->
        <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-6 md:gap-12 mb-10">
            <div class="flex-1 text-gray-900 text-sm md:text-base leading-relaxed space-y-4 font-medium">
                <p>Kamu telah mengamati lingkungan di sekitarmu dan menemukan berbagai kondisi yang terjadi.</p>
                <p>Sekarang, mari kita analisis bersama untuk memahami penyebab permasalahan tersebut dan menentukan solusi yang dapat dilakukan.</p>
            </div>
            <!-- Character -->
            <div class="w-32 h-40 md:w-44 md:h-56 shrink-0 hidden md:block md:-mt-6">
                <img src="{{ asset('assets/illustrations/character-3.png') }}" alt="Student Avatar" class="w-full h-full object-contain">
            </div>
            <!-- Mobile Character -->
            <div class="w-32 h-40 md:hidden shrink-0">
                <img src="{{ asset('assets/illustrations/character-3.png') }}" alt="Student Avatar" class="w-full h-full object-contain">
            </div>
        </div>

        <div class="space-y-8">
            <!-- Question 1 -->
            <div class="flex flex-col gap-3">
                <label class="text-gray-900 font-black text-lg md:text-xl">Perhatikan kembali hasil pengamatanmu!</label>
                <p class="text-gray-900 font-medium text-sm md:text-base">Apa persamaan masalah yang kamu temukan dengan peristiwa pada video sebelumnya?</p>
                <textarea wire:model="answers.q1" rows="4"
                    class="w-full p-5 mt-2 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y italic placeholder-gray-400"
                    placeholder="Jawaban"></textarea>
                @error('answers.q1')
                    <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Video Section -->
            <div class="bg-white p-5 md:p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-4 mt-6">
                <p class="text-gray-900 font-medium text-sm md:text-base leading-relaxed">
                    Sekarang, perhatikan video berikut untuk melihat penjelasan tentang penyebab dan solusi permasalahan lingkungan.
                </p>
                @if ($node->video_url)
                    <div class="w-full aspect-video rounded-xl overflow-hidden bg-black mt-2 shadow-sm border border-gray-100 relative group">
                        @php
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $node->video_url, $match);
                            $videoId = $match[1] ?? '';
                        @endphp
                        @if($videoId)
                            <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity" alt="Video Thumbnail">
                        @endif
                        <a href="{{ $node->video_url }}" target="_blank" class="absolute inset-0 flex items-center justify-center z-10">
                            <div class="w-16 h-16 md:w-20 md:h-20 bg-red-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-8 h-8 md:w-10 md:h-10 ml-1">
                                    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="w-full aspect-video bg-gray-200 rounded-xl flex items-center justify-center text-gray-500 font-medium mt-2 shadow-inner">
                        Video Tidak Tersedia
                    </div>
                @endif
            </div>

            <!-- Question 2 -->
            <div class="flex flex-col gap-3 mt-6">
                <label class="text-gray-900 font-black text-lg md:text-xl">Menentukan Solusi!</label>
                <p class="text-gray-900 font-medium text-sm md:text-base pr-0 md:pr-10">Apa solusi yang dapat kamu lakukan untuk mengatasi permasalahan lingkungan di sekitarmu? mengapa solusi tersebut penting dilakukan?</p>
                <textarea wire:model="answers.q2" rows="4"
                    class="w-full p-5 mt-2 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y italic placeholder-gray-400"
                    placeholder="Jawaban"></textarea>
                @error('answers.q2')
                    <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    @if (session()->has('message'))
        <div class="w-full bg-[#96C7F7] py-6 sm:py-8 mt-6" x-init="playSuccessEffects()">
            <div class="max-w-3xl mx-auto px-6 w-full flex flex-col sm:flex-row items-center justify-between gap-6 sm:gap-0">
                <div class="flex items-center gap-4 md:gap-5">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-[#E8F2FC] rounded-full flex items-center justify-center shrink-0">
                        <img src="{{ asset('assets/icons/etc/nice-job.png') }}" alt="Nice Job" class="w-8 h-8 md:w-10 md:h-10 object-contain">
                    </div>
                    <span class="font-black text-xl md:text-2xl text-black tracking-wide">Nice Job!</span>
                </div>
                <a href="{{ route('student.play-room', ['nodeId' => 5]) }}" wire:navigate
                    class="px-8 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base cursor-pointer text-center w-full sm:w-auto">
                    SELANJUTNYA
                </a>
            </div>
        </div>
    @else
        <div class="w-full border-t border-gray-400/50 bg-transparent py-6 md:py-8 mt-6">
            <div class="max-w-3xl mx-auto px-6 w-full flex justify-end">
                <button wire:click="submitNode4"
                    class="px-10 py-3 bg-[#99CB3A] hover:bg-[#8ab830] disabled:opacity-50 transition text-black font-black rounded shadow tracking-widest text-sm md:text-base w-full md:w-auto" wire:loading.attr="disabled">
                    KIRIM
                </button>
            </div>
        </div>
    @endif

    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
