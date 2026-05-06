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
        <h1 class="text-center font-black text-xl md:text-2xl mb-8 text-gray-900 tracking-wide">Mengapa Terjadi dan Bagaimana Solusinya?</h1>

        <!-- Intro text & Character -->
        <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-6 md:gap-12 mb-10">
            <div class="flex-1 text-gray-900 text-sm md:text-base leading-relaxed space-y-4 font-medium">
                <p>Kamu telah mengamati lingkungan di sekitarmu dan menemukan berbagai kondisi yang terjadi.</p>
                <p>Sekarang, mari kita analisis bersama untuk memahami penyebab permasalahan tersebut dan menentukan solusi yang dapat dilakukan.</p>
            </div>
            <!-- Character -->
            <div class="w-32 h-40 md:w-44 md:h-56 shrink-0 hidden md:block md:-mt-6">
                <img src="{{ asset('assets/illustrations/character-3.png') }}" alt="Student Avatar" class="w-full h-full object-contain" loading="lazy">
            </div>
            <!-- Mobile Character -->
            <div class="w-32 h-40 md:hidden shrink-0">
                <img src="{{ asset('assets/illustrations/character-3.png') }}" alt="Student Avatar" class="w-full h-full object-contain" loading="lazy">
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
                @php
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $node->video_url, $match);
                    $videoId = $match[1] ?? '';
                @endphp
                <x-student.video-player :videoId="$videoId" />
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

    <x-student.node-bottom-bar submitAction="submitNode4" :nextRoute="route('student.play-room', ['nodeId' => 5])" message="Luar biasa!" />

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>


    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
