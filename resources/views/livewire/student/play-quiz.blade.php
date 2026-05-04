<div class="min-h-screen flex flex-col font-sans relative" x-data="quizApp()">

    <!-- Top Navbar -->
    <div class="w-full flex items-center justify-between px-6 py-4 relative z-10 border-b border-gray-300/50">
        <!-- Back Button -->
        <a href="{{ route('student.quiz') }}"
            class="w-10 h-10 border-2 border-black rounded-lg flex items-center justify-center hover:bg-black/5 transition cursor-pointer bg-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="black"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </a>
        <!-- Title -->
        <h1 class="text-xl md:text-2xl font-extrabold text-black absolute left-1/2 -translate-x-1/2">
            Science Quiz
        </h1>
        <div class="w-10"></div> <!-- Placeholder for balancing -->
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 w-full max-w-4xl mx-auto px-4 py-6 md:py-10 flex flex-col pt-16 mt-4">
        
        <template x-if="!result">
            <div>
                <!-- Timer -->
                <div class="flex items-center justify-center gap-2 mb-8 text-[#FF5A5F] font-bold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span x-text="formattedTime">20:00</span>
                </div>

                <!-- Progress Bar -->
                <div class="mb-10">
                    <div class="flex justify-between items-end mb-2 text-sm font-bold text-black px-1">
                        <span x-text="`Pertanyaan ${currentIndex + 1} dari ${questions.length}`">Pertanyaan 1 dari 20</span>
                        <span x-text="`${progress}% Terselesaikan`">0% Terselesaikan</span>
                    </div>

                    <div class="w-full h-3 bg-gray-200 rounded-full overflow-hidden shadow-inner border border-gray-300/30">
                        <div class="h-full bg-[#8A2BE2] transition-all duration-500 rounded-full shadow-sm"
                            :style="`width: ${progress}%`"></div>
                    </div>
                </div>

                <!-- Question Card -->
                <div
                    class="bg-white rounded-xl shadow-sm p-6 md:p-10 mb-8 border border-white text-left flex flex-col items-start justify-start min-h-37.5">
                    <template x-if="currentQuestion">
                        <div class="text-base md:text-lg font-medium text-black leading-relaxed w-full">
                            <!-- Image Section -->
                            <template x-if="currentQuestion.image_path">
                                <div class="w-full mb-6" :style="`text-align: ${currentQuestion.image_settings?.position || 'center'}`">
                                    <div class="relative inline-block" :style="`width: ${currentQuestion.image_settings?.width || 100}%`">
                                        <img :src="`{{ asset('storage') }}/${currentQuestion.image_path}`" 
                                             class="w-full h-auto rounded-xl shadow-sm border border-gray-100"
                                             :style="`transform: rotate(${currentQuestion.image_settings?.rotation || 0}deg)`">
                                    </div>
                                </div>
                            </template>
                            
                            <!-- Question Text -->
                            <div x-html="currentQuestion.content"></div>
                        </div>
                    </template>
                </div>

                <!-- Options Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12 w-full" x-show="currentQuestion">
                    <template x-for="option in currentQuestion.options" :key="option.id">
                        <button @click="selectOption(currentQuestion.id, option.id)"
                            class="w-full p-4 rounded-xl border-2 font-medium text-sm md:text-base transition-all text-left flex items-center justify-start shadow-sm hover:shadow"
                            :class="answers[currentQuestion.id] === option.id ? 'bg-[#99CB3A] border-[#99CB3A] text-black' :
                                'bg-white border-white text-black hover:border-gray-200'"
                            x-text="option.text">
                        </button>
                    </template>
                </div>
            </div>
        </template>

        <template x-if="result">
            <div class="flex-1 flex flex-col items-center justify-center -mt-10"
                x-init="playSuccessEffects()"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0">
                
                <div class="w-48 h-60 md:w-64 md:h-80 mb-8">
                    <img src="{{ asset('assets/illustrations/character-4.png') }}" alt="Success Character" class="w-full h-full object-contain">
                </div>

                <h2 class="text-3xl md:text-4xl font-black text-black mb-4 tracking-wide text-center">Kuis Selesai!</h2>

                <template x-if="result.isLevelUp">
                    <div class="mb-10 bg-[#FFD700] text-black px-6 py-2 rounded-full font-black text-xl shadow-sm animate-bounce flex items-center gap-2 border-2 border-white">
                        <span>🚀</span> LEVEL UP! <span x-text="`LEVEL ${result.level}`"></span>
                    </div>
                </template>
                
                <template x-if="result.isNewBest">
                    <div class="mb-6 bg-green-100 text-green-700 px-4 py-1.5 rounded-full font-black text-sm tracking-wider border border-green-200">
                        ✨ SKOR TERBAIK BARU!
                    </div>
                </template>

                <div x-show="!result.isLevelUp && !result.isNewBest" class="mb-10"></div>

                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 w-full max-w-4xl">
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center gap-1 col-span-2 md:col-span-1">
                        <span class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Skor</span>
                        <span class="text-xl md:text-2xl font-black text-black" x-text="result.score">0</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center gap-1">
                        <span class="text-[10px] md:text-xs font-bold text-green-600 uppercase tracking-wider text-center">Benar</span>
                        <span class="text-xl md:text-2xl font-black text-green-700" x-text="result.correctCount">0</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center gap-1">
                        <span class="text-[10px] md:text-xs font-bold text-red-500 uppercase tracking-wider text-center">Salah</span>
                        <span class="text-xl md:text-2xl font-black text-red-600" x-text="result.incorrectCount">0</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center gap-1">
                        <span class="text-[10px] md:text-xs font-bold text-blue-600 uppercase tracking-wider text-center">XP</span>
                        <span class="text-xl md:text-2xl font-black text-blue-700" x-text="`+${result.earnedXp}`">+0</span>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center gap-1">
                        <span class="text-[10px] md:text-xs font-bold text-orange-600 uppercase tracking-wider text-center">Waktu</span>
                        <span class="text-xl md:text-2xl font-black text-orange-700" x-text="formatDuration(result.timeSpent)">00:00</span>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Bottom Navigation / Success Bar -->
    <div class="w-full transition-colors duration-500 mt-auto" 
        :class="result ? 'bg-[#96C7F7] py-6 sm:py-8' : 'border-t border-gray-300/50 py-6 md:py-8 bg-transparent'">
        
        <div class="max-w-4xl mx-auto px-6">
            <!-- Standard Navigation -->
            <template x-if="!result">
                <div class="flex items-center justify-between">
                    <button @click="prev()" x-show="currentIndex > 0"
                        class="px-4 md:px-8 py-2 md:py-3 bg-gray-200 hover:bg-gray-300 transition text-black font-black rounded-lg shadow-sm text-base">
                        SEBELUMNYA
                    </button>

                    <div class="flex-1" x-show="currentIndex < questions.length - 1"></div>
                    <div x-show="currentIndex === questions.length - 1"></div>

                    <button @click="next()" x-show="currentIndex < questions.length - 1"
                        class="px-4 md:px-8 py-2 md:py-3 bg-[#2D74DB] hover:bg-blue-600 transition text-white font-black rounded-lg shadow text-base">
                        SELANJUTNYA
                    </button>

                    <button @click="submit()" x-show="currentIndex === questions.length - 1"
                        class="px-8 md:px-14 py-2 md:py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow text-base cursor-pointer">
                        KIRIM
                    </button>
                </div>
            </template>

            <!-- Success Bar (Matching Node Style) -->
            <template x-if="result">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 sm:gap-0"
                    x-transition:enter="transition ease-out duration-500 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="flex items-center gap-4 md:gap-5">
                        <div class="w-14 h-14 md:w-16 md:h-16 bg-[#E8F2FC] rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('assets/icons/etc/nice-job.png') }}" alt="Nice Job"
                                class="w-8 h-8 md:w-10 md:h-10 object-contain">
                        </div>
                        <span class="font-black text-xl md:text-2xl text-black tracking-wide">Kamu berhasil menyelesaikan!</span>
                    </div>
                    <a href="{{ route('student.quiz') }}" wire:navigate
                        class="px-12 py-3 bg-[#99CB3A] hover:bg-[#8ab830] transition text-black font-black rounded shadow tracking-widest text-sm md:text-base cursor-pointer text-center w-full sm:w-auto">
                        SELESAI
                    </a>
                </div>
            </template>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('quizApp', () => ({
            questions: @js($questions),
            currentIndex: 0,
            answers: JSON.parse(localStorage.getItem('quiz_answers') || '{}'),
            timeSpent: parseInt(localStorage.getItem('quiz_timespent') || '0'),
            timerInterval: null,
            showModal: false,
            result: null,

            init() {
                this.timerInterval = setInterval(() => {
                    this.timeSpent++;
                    localStorage.setItem('quiz_timespent', this.timeSpent);
                }, 1000);

                this.$watch('answers', val => {
                    localStorage.setItem('quiz_answers', JSON.stringify(val));
                });
            },

            get currentQuestion() {
                return this.questions[this.currentIndex];
            },

            get progress() {
                if (this.questions.length === 0) return 0;
                let answeredCount = this.questions.filter(q => this.answers[q.id] !== undefined)
                    .length;
                let p = Math.round((answeredCount / this.questions.length) * 100);
                return Math.min(100, p);
            },

            get formattedTime() {
                let remaining = (20 * 60) - this.timeSpent;
                if (remaining < 0) remaining = 0;
                let m = Math.floor(remaining / 60).toString().padStart(2, '0');
                let s = (remaining % 60).toString().padStart(2, '0');
                return `${m}:${s}`;
            },

            formatDuration(seconds) {
                if (!seconds) return '00:00';
                let m = Math.floor(seconds / 60).toString().padStart(2, '0');
                let s = (seconds % 60).toString().padStart(2, '0');
                return `${m}:${s}`;
            },

            selectOption(questionId, optionId) {
                this.answers[questionId] = optionId;
                this.answers = {
                    ...this.answers
                };
            },

            next() {
                if (this.currentIndex < this.questions.length - 1) this.currentIndex++;
            },

            prev() {
                if (this.currentIndex > 0) this.currentIndex--;
            },

            playSuccessEffects() {
                let audio = new Audio('{{ asset('assets/sound/winners.mp3') }}');
                audio.play().catch(e => console.log('Audio play prevented:', e));

                if (typeof confetti === 'function') {
                    confetti({
                        particleCount: 200,
                        spread: 150,
                        origin: {
                            y: 1
                        },
                        startVelocity: 70,
                        zIndex: 99999
                    });
                }
            },

            async submit() {
                // Better validation: explicitly check for answers to all question IDs
                const answeredCount = this.questions.filter(q => this.answers[q.id] !== undefined && this.answers[q.id] !== null).length;
                const unansweredCount = this.questions.length - answeredCount;
                
                if (unansweredCount > 0) {
                    await Swal.fire({
                        title: 'Belum Selesai!',
                        text: `Maaf, Anda harus menjawab semua pertanyaan sebelum mengirim. Masih ada ${unansweredCount} pertanyaan yang tersisa.`,
                        icon: 'error',
                        confirmButtonColor: '#2D74DB',
                        confirmButtonText: 'Lanjutkan Mengerjakan',
                    });
                    return; // Strictly stop submission
                }

                // Show success loader
                Swal.fire({
                    title: 'Mengirim...',
                    text: 'Tunggu sebentar, kami sedang menghitung skor Anda.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                clearInterval(this.timerInterval);
                this.result = await this.$wire.submitQuiz(this.answers, this.timeSpent);

                localStorage.removeItem('quiz_answers');
                localStorage.removeItem('quiz_timespent');
            }
        }))
    })
</script>
