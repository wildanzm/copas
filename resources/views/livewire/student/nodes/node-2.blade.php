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
                <!-- Progress Bar: Node 2 -->
                <div class="h-full bg-[#99CB3A] w-[40%] transition-all duration-500 rounded-full"></div>
            </div>
        </div>
        <div class="w-8"></div>
    </div>

    <!-- Content Area -->
    <div class="max-w-3xl mx-auto w-full px-4 sm:px-6 pb-12 flex-1">
        <h1 class="text-center font-black text-xl md:text-2xl mb-8 md:mb-12 text-gray-900 tracking-wide">
            {{ $node->title }}</h1>

        <p class="text-center font-bold text-gray-900 text-lg md:text-xl mb-12">Pilih jawaban yang menurutmu benar!</p>

        <div class="space-y-12">
            @foreach ($node->questions as $index => $question)
                <div class="flex flex-col items-center gap-6">
                    <p class="text-center font-medium text-gray-900 text-base md:text-lg leading-relaxed max-w-2xl">
                        "{{ $question->content }}"
                    </p>
                    <div class="flex items-center gap-6 md:gap-14">
                        <button type="button" wire:click="$set('answers.q{{ $index + 1 }}', 'Benar')"
                            class="px-8 py-3 rounded text-black font-bold shadow-sm transition-transform hover:scale-105
                                {{ isset($answers['q' . ($index + 1)]) && $answers['q' . ($index + 1)] === 'Benar' ? 'bg-[#76e56b] scale-105 ring-4 ring-[#76e56b]/30' : 'bg-[#A8FF9F] hover:bg-[#8def82]' }}">
                            Benar
                        </button>

                        <button type="button" wire:click="$set('answers.q{{ $index + 1 }}', 'Salah')"
                            class="px-8 py-3 rounded text-black font-bold shadow-sm transition-transform hover:scale-105
                                {{ isset($answers['q' . ($index + 1)]) && $answers['q' . ($index + 1)] === 'Salah' ? 'bg-[#ff6e6e] scale-105 ring-4 ring-[#ff6e6e]/30' : 'bg-[#FF8B8B] hover:bg-[#df7070]' }}">
                            Salah
                        </button>
                    </div>
                    @error('answers.q' . ($index + 1))
                        <span class="text-red-500 font-bold text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bottom Bar (Border + Button / Success Banner) -->
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
                <a href="{{ route('student.play-room', ['nodeId' => 3]) }}" wire:navigate
                    class="px-8 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base cursor-pointer text-center w-full sm:w-auto">
                    SELANJUTNYA
                </a>
            </div>
        </div>
    @else
        <div class="w-full border-t border-gray-400/50 bg-transparent py-6 md:py-8 mt-6">
            <div class="max-w-3xl mx-auto px-6 w-full flex justify-end">
                <button wire:click="submitNode2"
                    class="px-10 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base w-full md:w-auto">
                    KIRIM
                </button>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
