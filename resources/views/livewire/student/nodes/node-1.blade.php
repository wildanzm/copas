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
        // Load from local storage
        const saved = localStorage.getItem('node_answers_{{ $node->id }}');
        if (saved) {
            this.answers = JSON.parse(saved);
        }

        // Save to local storage on change
        this.$watch('answers', value => {
            localStorage.setItem('node_answers_{{ $node->id }}', JSON.stringify(value));
        });
    }
}">
    <x-student.node-header :progress="$progressPercentage" />

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
                    class="w-full h-full object-contain" loading="lazy">
            </div>
        </div>

        <!-- Video Section -->
        <div class="bg-white rounded-xl p-6 md:p-8 shadow-sm mb-12 w-full border border-gray-200 relative z-10 -mt-16 md:-mt-12">
            <p class="text-gray-900 font-medium mb-6 text-sm md:text-base pr-0 md:pr-4">Ayo tonton video berikut dengan
                saksama!<br>Perhatikan kondisi lingkungan, kejadian yang terjadi, dan dampaknya bagi masyarakat.</p>
            
            @php
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $node->video_url, $match);
                $videoId = $match[1] ?? '';
            @endphp
            <x-student.video-player :videoId="$videoId" />
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

    <x-student.node-bottom-bar submitAction="submitNode1" :nextRoute="route('student.play-room', ['nodeId' => 2])" />

    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>


    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
