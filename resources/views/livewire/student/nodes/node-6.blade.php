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
                <!-- Progress Bar: Node 6 -->
                <div class="h-full bg-[#99CB3A] w-[100%] transition-all duration-500 rounded-full"></div>
            </div>
        </div>
        <div class="w-8"></div>
    </div>

    <!-- Content Area -->
    <div
        class="max-w-3xl mx-auto w-full px-4 sm:px-6 pb-12 flex-1 flex flex-col @if (session()->has('message')) justify-center @endif">
        @if (session()->has('message'))
            <!-- Completion Card -->
            <div class="bg-white rounded-2xl shadow-sm p-8 md:p-10 w-full max-w-md mx-auto relative overflow-hidden flex flex-col items-center text-center -mt-12"
                x-init="playSuccessEffects()">
                <div class="absolute top-0 left-0 w-full h-32 bg-cover bg-top bg-no-repeat"
                    style="background-image: url('{{ asset('assets/images/background/bg-confetti.png') }}')"></div>

                <h2 class="text-lg md:text-xl font-extrabold text-gray-900 mb-8 mt-20 z-10 leading-snug">Selamat! Kamu
                    telah menyelesaikan<br>seluruh pembelajaran</h2>

                <div class="flex items-center justify-center gap-4 z-10 w-full px-2">
                    <p class="text-gray-800 font-medium text-base md:text-lg leading-snug">Jadilah penjaga<br>lingkungan
                        yang baik!</p>
                    <div class="w-28 h-36 shrink-0">
                        <img src="{{ asset('assets/illustrations/character-4.png') }}"
                            onerror="this.src='{{ asset('assets/illustrations/character-3.png') }}'"
                            alt="Student Avatar" class="w-full h-full object-contain drop-shadow-sm">
                    </div>
                </div>
            </div>
        @else
            <h1 class="text-center font-black text-xl md:text-2xl mb-12 text-gray-900 tracking-wide">Ayo Melakukan
                Refleksi</h1>

            <div class="space-y-8">
                <!-- Question 1 -->
                <div class="flex flex-col gap-3">
                    <p class="text-gray-900 font-medium text-sm md:text-base">Apa hal baru yang kamu pelajari hari ini?
                    </p>
                    <textarea wire:model="answers.q1" rows="5"
                        class="w-full p-5 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y italic placeholder-gray-400"
                        placeholder="Jawaban"></textarea>
                    @error('answers.q1')
                        <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Question 2 -->
                <div class="flex flex-col gap-3 mt-6">
                    <p class="text-gray-900 font-medium text-sm md:text-base">Mengapa menjaga lingkungan itu penting?
                    </p>
                    <textarea wire:model="answers.q2" rows="5"
                        class="w-full p-5 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y italic placeholder-gray-400"
                        placeholder="Jawaban"></textarea>
                    @error('answers.q2')
                        <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Question 3 -->
                <div class="flex flex-col gap-3 mt-6">
                    <p class="text-gray-900 font-medium text-sm md:text-base">Apa yang akan kamu lakukan mulai sekarang
                        untuk menjaga lingkungan?</p>
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
                    <p>Dengan kebiasaan sederhana seperti membuang sampah pada tempatnya, kita dapat mencegah berbagai
                        permasalahan lingkungan.</p>
                </div>
                <!-- Character -->
                <div class="w-32 h-40 md:w-44 md:h-56 shrink-0 md:-mt-6">
                    <img src="{{ asset('assets/illustrations/character-3.png') }}"
                        onerror="this.src='{{ asset('assets/illustrations/character-3.png') }}'" alt="Student Avatar"
                        class="w-full h-full object-contain">
                </div>
            </div>
        @endif
    </div>

    <!-- Bottom Bar -->
    <div class="w-full border-t border-gray-400/50 bg-transparent py-6 md:py-8 mt-auto">
        <div
            class="max-w-3xl mx-auto px-6 w-full flex @if (session()->has('message')) justify-center @else justify-end @endif">
            @if (session()->has('message'))
                <a href="{{ route('student.dashboard') }}" wire:navigate
                    class="px-14 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base cursor-pointer text-center w-full sm:w-auto mt-2">
                    SELESAI
                </a>
            @else
                <button wire:click="submitNode6"
                    class="px-10 py-3 bg-[#99CB3A] hover:bg-[#8ab830] disabled:opacity-50 transition text-black font-black rounded shadow tracking-widest text-sm md:text-base w-full md:w-auto"
                    wire:loading.attr="disabled">
                    KIRIM
                </button>
            @endif
        </div>
    </div>

    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
