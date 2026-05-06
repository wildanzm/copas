<div class="min-h-screen flex flex-col font-sans" x-data="{
    answers: @entangle('answers'),
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
    },
    init() {
        if ({{ session()->has('message') ? 'true' : 'false' }}) {
            localStorage.removeItem('node_answers_{{ $node->id }}');
        } else {
            const saved = localStorage.getItem('node_answers_{{ $node->id }}');
            if (saved) {
                this.answers = JSON.parse(saved);
            }
        }

        this.$watch('answers', value => {
            localStorage.setItem('node_answers_{{ $node->id }}', JSON.stringify(value));
        });
    }
}">
    <x-student.node-header :progress="$progressPercentage" />

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

    <x-student.node-bottom-bar submitAction="submitNode2" :nextRoute="route('student.play-room', ['nodeId' => 3])" message="Kamu berhasil menyelesaikan!" />

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>


    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
