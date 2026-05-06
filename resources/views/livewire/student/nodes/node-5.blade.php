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
        <h1 class="text-center font-black text-xl md:text-2xl mb-8 text-gray-900 tracking-wide uppercase">ALAM BERUBAH,
            KITA WASPADA!</h1>

        <!-- Intro text & Character -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start justify-between gap-6 md:gap-12 mb-8 mt-4 md:mt-8">
            <div class="flex-1 text-gray-900 text-sm md:text-base leading-relaxed space-y-4">
                <p>Pernahkah kamu berpikir, mengapa udara sekarang terasa lebih panas? Atau mengapa gunung yang penuh
                    pohon tiba-tiba bisa longsor? Apakah itu semua karena ulah alam sendiri, atau ada campur tangan
                    manusia di dalamnya?</p>
            </div>
            <!-- Character -->
            <div class="w-28 h-36 md:w-32 md:h-44 shrink-0 md:-mt-8">
                <img src="{{ asset('assets/illustrations/character-2.png') }}" alt="Student Avatar"
                    class="w-full h-full object-contain" loading="lazy">
            </div>
        </div>

        <!-- Video Box -->
        <div
            class="bg-white rounded-xl p-5 md:p-8 shadow-sm border border-gray-200 flex flex-col gap-4 mb-8 relative z-10 w-full md:-mt-12 -mt-16">
            <p class="text-gray-900 font-medium text-sm md:text-base pr-0 md:pr-4">Ayo tonton video animasi berikut
                untuk memahami bagaimana lingkungan kita berubah dan apa dampaknya bagi kita!</p>
            @php
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $node->video_url, $match);
                $videoId = $match[1] ?? '';
            @endphp
            <x-student.video-player :videoId="$videoId" />
        </div>

        <!-- Challenge Area -->
        <div class="flex flex-col gap-3">
            <h2 class="text-gray-900 font-extrabold text-lg md:text-xl">Tantangan Nyata!</h2>
            <p class="text-gray-900 font-medium text-sm md:text-base">Tuliskan satu kegiatan yang bisa kamu lakukan di
                sekolah untuk membantu mengurangi pencemaran lingkungan atau mungkin mencegah bencana lainnya!</p>
            <textarea wire:model="answers.q1" rows="5"
                class="w-full p-5 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y italic placeholder-gray-400 mt-2"
                placeholder="Jawaban"></textarea>
            @error('answers.q1')
                <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <x-student.node-bottom-bar submitAction="submitNode5" :nextRoute="route('student.play-room', ['nodeId' => 6])" message="Teruskan semangat belajarmu!" />

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>


    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
