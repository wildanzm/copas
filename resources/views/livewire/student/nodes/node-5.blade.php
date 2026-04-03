<div class="min-h-screen flex flex-col font-sans" x-data="{
    playSuccessEffects() {
        let audio = new Audio('{{ asset('assets/sound/winners.mp3') }}');
        audio.play().catch(e => console.log('Audio play prevented:', e));

        if (typeof confetti === 'function') {
            confetti({
                particleCount: 200,
                spread: 150,
                origin: { y: 1 },
                startVelocity: 70,
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
                <!-- Progress Bar: Node 5 -->
                <div class="h-full bg-[#99CB3A] w-[100%] transition-all duration-500 rounded-full"></div>
            </div>
        </div>
        <div class="w-8"></div>
    </div>

    <!-- Content Area -->
    <div class="max-w-3xl mx-auto w-full px-4 sm:px-6 pb-12 flex-1">
        <h1 class="text-center font-black text-xl md:text-2xl mb-12 text-gray-900 tracking-wide">Ayo Melakukan Refleksi</h1>

        <div class="space-y-8">
            <!-- Question 1 -->
            <div class="flex flex-col gap-3">
                <p class="text-gray-900 font-medium text-sm md:text-base">Apa hal baru yang kamu pelajari hari ini?</p>
                <textarea wire:model="answers.q1" rows="5"
                    class="w-full p-5 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y italic placeholder-gray-400"
                    placeholder="Jawaban"></textarea>
                @error('answers.q1')
                    <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Question 2 -->
            <div class="flex flex-col gap-3 mt-6">
                <p class="text-gray-900 font-medium text-sm md:text-base">Mengapa menjaga lingkungan itu penting?</p>
                <textarea wire:model="answers.q2" rows="5"
                    class="w-full p-5 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y italic placeholder-gray-400"
                    placeholder="Jawaban"></textarea>
                @error('answers.q2')
                    <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                @enderror
            </div>

            <!-- Question 3 -->
            <div class="flex flex-col gap-3 mt-6">
                <p class="text-gray-900 font-medium text-sm md:text-base">Apa yang akan kamu lakukan mulai sekarang untuk menjaga lingkungan?</p>
                <textarea wire:model="answers.q3" rows="5"
                    class="w-full p-5 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y italic placeholder-gray-400"
                    placeholder="Jawaban"></textarea>
                @error('answers.q3')
                    <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Outro text & Character -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 md:gap-12 mt-12 mb-8">
            <div class="flex-1 text-gray-900 text-sm md:text-base leading-relaxed space-y-4 font-black">
                <p>Menjaga lingkungan adalah tanggung jawab kita bersama.</p>
                <p>Dengan kebiasaan sederhana seperti membuang sampah pada tempatnya, kita dapat mencegah berbagai permasalahan lingkungan.</p>
            </div>
            <!-- Character -->
            <div class="w-32 h-40 md:w-44 md:h-56 shrink-0 md:-mt-6">
                <img src="{{ asset('assets/illustrations/character-3.png') }}" onerror="this.src='{{ asset('assets/illustrations/character-3.png') }}'" alt="Student Avatar" class="w-full h-full object-contain">
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
                    <span class="font-black text-xl md:text-2xl text-black tracking-wide">Selamat!</span>
                </div>
                <a href="{{ route('student.dashboard') }}" wire:navigate
                    class="px-8 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base cursor-pointer text-center w-full sm:w-auto">
                    KEMBALI KE BERANDA
                </a>
            </div>
        </div>
    @else
        <div class="w-full border-t border-gray-400/50 bg-transparent py-6 md:py-8 mt-6">
            <div class="max-w-3xl mx-auto px-6 w-full flex justify-end">
                <button wire:click="submitNode5"
                    class="px-10 py-3 bg-[#99CB3A] hover:bg-[#8ab830] disabled:opacity-50 transition text-black font-black rounded shadow tracking-widest text-sm md:text-base w-full md:w-auto" wire:loading.attr="disabled">
                    KIRIM
                </button>
            </div>
        </div>
    @endif

    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
