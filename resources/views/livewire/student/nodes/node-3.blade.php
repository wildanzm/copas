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
                <!-- Progress Bar: Node 3 -->
                <div class="h-full bg-[#99CB3A] w-[60%] transition-all duration-500 rounded-full"></div>
            </div>
        </div>
        <div class="w-8"></div>
    </div>

    <!-- Content Area -->
    <div class="max-w-3xl mx-auto w-full px-4 sm:px-6 pb-12 flex-1">
        <h1 class="text-center font-black text-xl md:text-2xl mb-8 text-gray-900 tracking-wide">Ayo Amati Lingkungan
            Sekitarmu!</h1>

        <!-- Intro text & Character -->
        <div
            class="flex flex-col md:flex-row items-center md:items-start justify-between gap-6 md:gap-12 mb-8 mt-4 md:mt-8">
            <div class="flex-1 text-gray-900 text-sm md:text-base leading-relaxed space-y-4">
                <p>Setelah mengetahui permasalahan pada video sebelumnya, sekarang saatnya kamu melakukan pengamatan
                    langsung di lingkungan sekitarmu.</p>
                <p>Melalui kegiatan ini, kamu akan menemukan sendiri kondisi lingkungan serta permasalahan yang mungkin
                    terjadi di sekitarmu.</p>
            </div>
            <!-- Character -->
            <div class="w-28 h-36 md:w-40 md:h-52 shrink-0 hidden md:block md:-mt-8">
                <img src="{{ asset('assets/illustrations/character-2.png') }}" alt="Student Avatar"
                    class="w-full h-full object-contain">
            </div>
        </div>

        <div class="text-gray-900 mb-8 max-w-2xl text-sm md:text-base leading-relaxed">
            <h2 class="font-black text-lg md:text-xl mb-2">Instruksi</h2>
            <p>Lakukan kegiatan berikut dengan tertib:</p>
            <ol class="list-decimal pl-5 space-y-1 mb-4 font-medium">
                <li>Perhatikan lingkungan di sekitar atau dapat mencarinya di internet.</li>
                <li>Pilih tempat yang menurutmu menarik untuk diamati.</li>
                <li>Ambil satu foto kondisi lingkungan tersebut dan upload</li>
                <li>Jelaskan gambar tersebut.</li>
            </ol>

            <div class="pl-4 border-l-4 border-[#99CB3A] ml-2 space-y-4">
                <div>
                    <h3 class="font-black">Jika lingkungan KOTOR</h3>
                    <ul class="list-disc pl-5 font-medium">
                        <li>Jelaskan penyebab dan dampak lingkungan kotor tersebut dan berikan solusinya.</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-black">Jika Lingkungan BERSIH</h3>
                    <ul class="list-disc pl-5 font-medium">
                        <li>Jelaskan mengapa lingkungan tersebut tetap bersih dan bagaimana cara menjaga lingkungan
                            tetap bersih.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mobile Character (since hidden above) -->
        <div class="w-28 h-36 md:hidden relative mr-4 shrink-0 mx-auto -mt-6 mb-4 z-20">
            <img src="{{ asset('assets/illustrations/character-2.png') }}" class="w-full h-full object-contain">
        </div>

        <div class="w-full space-y-8">
            <!-- Upload Box -->
            <div class="flex flex-col items-center justify-center w-full min-h-[250px] border-2 border-transparent bg-white shadow-sm rounded-2xl cursor-pointer hover:bg-gray-50 transition-colors relative overflow-hidden"
                x-data="{ isDragging: false }" @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                @drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }))"
                :class="{ 'ring-4 ring-[#99CB3A]/50 bg-gray-50': isDragging }">

                <input type="file" wire:model="photo" accept="image/*"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" x-ref="fileInput">

                @if ($photo)
                    <!-- Preview -->
                    <div class="w-full h-full absolute inset-0 z-10 flex items-center justify-center bg-black/90 group">
                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-contain">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center pointer-events-none">
                            <span class="text-white font-bold text-lg drop-shadow-md">Klik atau seret untuk mengganti
                                foto</span>
                        </div>
                    </div>
                @else
                    <div class="text-center p-6 pointer-events-none relative z-10 flex flex-col items-center">
                        <span class="font-black text-black text-xl mb-1">Upload/Ambil Gambar</span>
                        <span class="text-gray-500 text-sm font-medium">Maksimal 2MB</span>

                        <div wire:loading wire:target="photo" class="mt-4 text-[#99CB3A] font-bold">
                            Mengunggah...
                        </div>
                    </div>
                @endif
            </div>

            @error('photo')
                <span class="text-red-500 text-sm font-bold block -mt-4">{{ $message }}</span>
            @enderror

            <!-- Penjelasan Area -->
            <div class="flex flex-col gap-3">
                <label class="text-gray-900 font-extrabold text-lg md:text-xl">Penjelasan</label>
                <textarea wire:model="answers.q1" rows="5"
                    class="w-full p-5 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y"
                    placeholder="Hasil pengamatanku..."></textarea>
                @error('answers.q1')
                    <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
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
                <a href="{{ route('student.play-room', ['nodeId' => 4]) }}" wire:navigate
                    class="px-8 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base cursor-pointer text-center w-full sm:w-auto">
                    SELANJUTNYA
                </a>
            </div>
        </div>
    @else
        <div class="w-full border-t border-gray-400/50 bg-transparent py-6 md:py-8 mt-6">
            <div class="max-w-3xl mx-auto px-6 w-full flex justify-end">
                <button wire:click="submitNode3"
                    class="px-10 py-3 bg-[#99CB3A] hover:bg-[#8ab830] disabled:opacity-50 transition text-black font-black rounded shadow tracking-widest text-sm md:text-base w-full md:w-auto"
                    wire:loading.attr="disabled">
                    KIRIM
                </button>
            </div>
        </div>
    @endif

    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>
