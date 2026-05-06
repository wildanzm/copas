<div class="min-h-screen flex flex-col font-sans" x-data="{
    isCompressing: false,
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
    },
    async handleFileSelect(event) {
        const files = event.target.files || event.dataTransfer.files;
        if (!files.length) return;
        
        let file = files[0];
        
        if (file.size > 2 * 1024 * 1024) {
            this.isCompressing = true;
            try {
                file = await this.compressImage(file);
            } catch (err) {
                console.error('Compression error:', err);
            } finally {
                this.isCompressing = false;
            }
        }
        
        @this.upload('photo', file);
    },
    compressImage(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (e) => {
                const img = new Image();
                img.src = e.target.result;
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;
                    
                    const maxDim = 1600;
                    if (width > maxDim || height > maxDim) {
                        if (width > height) {
                            height *= maxDim / width;
                            width = maxDim;
                        } else {
                            width *= maxDim / height;
                            height = maxDim;
                        }
                    }
                    
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);
                    
                    canvas.toBlob((blob) => {
                        if (!blob) {
                            reject(new Error('Canvas to Blob failed'));
                            return;
                        }
                        resolve(new File([blob], file.name, { type: 'image/jpeg' }));
                    }, 'image/jpeg', 0.7);
                };
            };
            reader.onerror = reject;
        });
    }
}">
    <x-student.node-header :progress="$progressPercentage" />

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
                    class="w-full h-full object-contain" loading="lazy">
            </div>
        </div>

        <div class="text-gray-900 mb-8 max-w-2xl text-sm md:text-base leading-relaxed">
            <h2 class="font-black text-lg md:text-xl mb-2">Instruksi</h2>
            <p>Lakukan kegiatan berikut dengan tertib:</p>
            <ol class="list-decimal pl-5 space-y-1 mb-2 font-medium">
                <li>Perhatikan lingkungan di sekitar atau dapat mencarinya di internet.</li>
                <li>Cari lingkungan yang menurut kamu kotor atau tidak bersih</li>
                <li>Ambil satu foto kondisi lingkungan tersebut dan upload</li>
                <li>Kemudian berikan penjelasan.</li>
            </ol>

            <ul class="list-disc pl-9 font-medium space-y-1">
                <li>Jelaskan penyebab dan dampak lingkungan kotor tersebut dan berikan solusinya.</li>
            </ul>
        </div>

        <!-- Mobile Character -->
        <div class="w-28 h-36 md:hidden relative mr-4 shrink-0 mx-auto -mt-6 mb-4 z-20">
            <img src="{{ asset('assets/illustrations/character-2.png') }}" class="w-full h-full object-contain" loading="lazy">
        </div>

        <div class="w-full space-y-8">
            <!-- Upload Box -->
            <div class="flex flex-col items-center justify-center w-full min-h-[250px] border-2 border-transparent bg-white shadow-sm rounded-2xl cursor-pointer hover:bg-gray-50 transition-colors relative overflow-hidden"
                x-data="{ isDragging: false }" @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                @drop.prevent="isDragging = false; handleFileSelect($event)"
                :class="{ 'ring-4 ring-[#99CB3A]/50 bg-gray-50': isDragging }">

                <input type="file" @change="handleFileSelect" accept="image/*"
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
                        <div x-show="isCompressing" class="mt-4 text-blue-500 font-bold" x-cloak>
                            Mengompres Gambar...
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
                    class="w-full p-5 rounded-2xl border-0 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2072d8] bg-white text-gray-800 font-medium text-sm md:text-base resize-y placeholder:italic"
                    placeholder="Jawaban"></textarea>
                @error('answers.q1')
                    <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <x-student.node-bottom-bar submitAction="submitNode3" :nextRoute="route('student.play-room', ['nodeId' => 4])" message="Luar Biasa! Hasil observasimu berhasil dikirim." />

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
</div>

