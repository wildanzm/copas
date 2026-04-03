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
                <!-- Progress Bar -->
                <div class="h-full bg-gray-200 w-[15%]"></div>
            </div>
        </div>
        <div class="w-8"></div> <!-- spacer to balance the X button -->
    </div>

    <!-- Content Area -->
    <div class="max-w-3xl mx-auto w-full px-4 sm:px-6 pb-12 flex-1">
        <h1 class="text-center font-bold text-xl md:text-2xl mb-2 md:mb-12 text-gray-900 tracking-wide">Lingkungan di
            Sekitar Kita
        </h1>

        <!-- Intro text & Character -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-16 md:mb-8 mt-4 md:mt-8">
            <div class="flex-1 space-y-4 text-gray-900 text-sm md:text-base leading-relaxed">
                <p>Hujan deras sering terjadi di berbagai daerah. Namun, mengapa hujan yang sebentar bisa menyebabkan
                    banjir?</p>
                <p>Apa yang sebenarnya terjadi di lingkungan tersebut?</p>
            </div>
            <div
                class="w-32 h-40 md:w-36 md:h-48 shrink-0 relative mt-[-20px] md:-mt-16 ml-auto mr-4 md:mr-0 md:ml-0 self-end md:self-auto">
                <img src="{{ asset('assets/illustrations/character-1.png') }}" alt="Student Avatar"
                    class="w-full h-full object-contain">
            </div>
        </div>

        <!-- Video Section (White Card) -->
        <div
            class="bg-white rounded-xl p-6 md:p-8 shadow-sm mb-12 w-full border border-gray-200 relative z-10 -mt-16 md:-mt-12">
            <p class="text-gray-900 font-medium mb-6 text-sm md:text-base pr-0 md:pr-4">Ayo tonton video berikut dengan
                saksama!<br>Perhatikan kondisi lingkungan, kejadian yang terjadi, dan dampaknya bagi masyarakat.</p>
            <div class="aspect-video w-full overflow-hidden bg-[#F98E8E] flex items-center justify-center">
                @if ($node->video_url)
                    <iframe src="{{ $this->getEmbedVideoUrl() }}" class="w-full h-full border-0" title="YouTube video"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                @else
                    <span class="text-gray-900 font-medium">video</span>
                @endif
            </div>
        </div>

        <!-- Analisis Section -->
        <h2 class="font-bold text-lg md:text-xl mb-6 text-gray-900">Setelah menonton video tersebut, mari kita analisis!
        </h2>

        <div class="space-y-6">
            <!-- Q1 -->
            <div class="flex flex-col gap-2">
                <label class="text-gray-900 font-medium text-sm md:text-base">Apa masalah utama yang terjadi pada video
                    tersebut?</label>
                <textarea wire:model="answers.q1" rows="4"
                    class="w-full p-4 rounded-xl border border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white placeholder-gray-400 italic text-sm resize-y"
                    placeholder="Jawaban"></textarea>
                @error('answers.q1')
                    <span class="text-red-500 text-sm font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Q2 -->
            <div class="flex flex-col gap-2">
                <label class="text-gray-900 font-medium text-sm md:text-base">Apa saja dampak yang ditimbulkan dari
                    peristiwa tersebut?</label>
                <textarea wire:model="answers.q2" rows="4"
                    class="w-full p-4 rounded-xl border border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white placeholder-gray-400 italic text-sm resize-y"
                    placeholder="Jawaban"></textarea>
                @error('answers.q2')
                    <span class="text-red-500 text-sm font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Q3 -->
            <div class="flex flex-col gap-2">
                <label class="text-gray-900 font-medium text-sm md:text-base">Menurut pendapatmu, apa yang menyebabkan
                    kondisi tersebut bisa terjadi?</label>
                <textarea wire:model="answers.q3" rows="4"
                    class="w-full p-4 rounded-xl border border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white placeholder-gray-400 italic text-sm resize-y"
                    placeholder="Jawaban"></textarea>
                @error('answers.q3')
                    <span class="text-red-500 text-sm font-medium">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- Bottom Bar (Border + Button) -->
    @if (session()->has('message'))
        <div class="w-full bg-[#96C7F7] py-6 sm:py-8 mt-6" x-init="playSuccessEffects()">
            <div
                class="max-w-3xl mx-auto px-6 w-full flex flex-col sm:flex-row items-center justify-between gap-6 sm:gap-0">
                <div class="flex items-center gap-4 md:gap-5">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-[#E8F2FC] rounded-full flex items-center justify-center shrink-0">
                        <img src="{{ asset('assets/icons/etc/nice-job.png') }}" alt="Nice Job"
                            class="w-8 h-8 md:w-10 md:h-10 object-contain">
                    </div>
                    <span class="font-black text-xl md:text-2xl text-black tracking-wide">Nice Job!</span>
                </div>
                <a href="{{ route('student.play-room', ['nodeId' => 2]) }}" wire:navigate
                    class="px-8 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base cursor-pointer text-center w-full sm:w-auto">
                    SELANJUTNYA
                </a>
            </div>
        </div>
    @else
        <div class="w-full border-t border-gray-400/50 bg-transparent py-6 md:py-8 mt-6">
            <div class="max-w-3xl mx-auto px-6 w-full flex justify-end">
                <button wire:click="submitNode1"
                    class="px-10 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base w-full md:w-auto">
                    KIRIM
                </button>
            </div>
        </div>
    @endif

    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
