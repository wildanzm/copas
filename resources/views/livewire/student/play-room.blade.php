<div class="w-full h-full flex flex-col relative">
    @include($nodeView)

    <!-- Game-like Level Up / XP Modal -->
    @if ($showModal)
        <div x-show="show" x-transition.opacity.duration.500ms
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto"
            x-data="{
                show: false,
                currentXp: {{ $oldXp }},
                targetXp: {{ $newXp }},
                currentLevel: {{ $oldLevel }},
                progressPercent: {{ $oldXp % 100 }},
                isLevelUp: false,
                earnedXpAnimated: 0,
                animateXP() {
                    let start = null;
                    let duration = 1000;
                    let oldXp = this.currentXp;
                    let diff = this.targetXp - oldXp;
            
                    const step = (timestamp) => {
                        if (!start) start = timestamp;
                        let progress = Math.min((timestamp - start) / duration, 1);
            
                        let ease = 1 - Math.pow(1 - progress, 4);
            
                        this.currentXp = Math.floor(oldXp + (diff * ease));
                        this.earnedXpAnimated = Math.floor(diff * ease);
            
                        this.currentLevel = Math.min(10, Math.floor(this.currentXp / 100) + 1);
            
                        if (this.currentLevel > {{ $oldLevel }}) {
                            this.isLevelUp = true;
                        }
            
                        if (this.currentLevel === 10) {
                            this.progressPercent = 100;
                        } else {
                            this.progressPercent = this.currentXp % 100;
                        }
            
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        }
                    };
                    window.requestAnimationFrame(step);
                }
            }" x-init="setTimeout(() => {
                show = true;
                animateXP();
            
                setTimeout(() => {
                    show = false;
                }, 2000);
            }, 100);
            let audio = new Audio('{{ asset('assets/sound/winners.mp3') }}');
            audio.play().catch(e => console.log('Audio play prevented:', e));">

            <div x-show="show" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-50 translate-y-10"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-10"
                class="bg-white rounded-3xl w-full max-w-sm flex flex-col items-center justify-center p-8 shadow-2xl relative border-4 border-[#99CB3A] text-center my-auto">

                <!-- Close Button -->
                <button @click="show = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-full p-1.5 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Confetti Canvas -->
                <canvas id="modal-confetti" class="absolute inset-0 w-full h-full pointer-events-none rounded-3xl"
                    x-init="const duration = 3000;
                    const end = Date.now() + duration;
                    const frame = function() {
                        confetti({
                            particleCount: 5,
                            angle: 60,
                            spread: 55,
                            origin: { x: 0 },
                            colors: ['#FFE345', '#99CB3A', '#FF5D5D']
                        });
                        confetti({
                            particleCount: 5,
                            angle: 120,
                            spread: 55,
                            origin: { x: 1 },
                            colors: ['#FFE345', '#99CB3A', '#FF5D5D']
                        });
                    
                        if (Date.now() < end) {
                            requestAnimationFrame(frame);
                        }
                    };
                    frame();"></canvas>

                <!-- Icon/Badge Top -->
                <div
                    class="w-24 h-24 bg-[#E8F2FC] rounded-full flex items-center justify-center -mt-16 mb-4 shadow-lg border-4 border-white relative z-10">
                    <img src="{{ asset('assets/icons/etc/nice-job.png') }}" alt="Nice Job"
                        class="w-14 h-14 object-contain">
                </div>

                <h2 class="text-3xl font-black text-gray-900 mb-2 tracking-wide uppercase">{{ session('message') }}</h2>
                <p class="text-gray-500 font-medium mb-6">Kerja bagus, jawabanmu telah tersimpan!</p>

                <!-- Score Container -->
                <div class="bg-[#F8FAFC] w-full rounded-2xl p-5 mb-6 border border-gray-100 shadow-inner">
                    <!-- If Node 2, show correct/incorrect stats -->
                    @if ($node->order_index === 2)
                        <div class="flex justify-center gap-6 mb-4">
                            <div class="flex flex-col items-center">
                                <span class="text-3xl font-black text-[#99CB3A]">{{ $correctCount }}</span>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Benar</span>
                            </div>
                            <div class="w-px bg-gray-200"></div>
                            <div class="flex flex-col items-center">
                                <span class="text-3xl font-black text-[#FF5D5D]">{{ $incorrectCount }}</span>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Salah</span>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-gray-600 text-sm">Level <span x-text="currentLevel"></span></span>
                        <div class="flex items-center bg-[#FFE345]/20 px-2 py-1 rounded-full border border-[#FFE345]">
                            <span class="text-sm font-black text-[#D4B300]">+<span
                                    x-text="earnedXpAnimated"></span></span>
                            <img src="{{ asset('assets/icons/etc/medal.png') }}" class="w-4 h-4 ml-1" alt="XP">
                        </div>
                    </div>

                    <!-- Progress Bar Animation -->
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden relative shadow-inner">
                        <div class="bg-[#99CB3A] h-full rounded-full transition-all duration-75 relative"
                            :style="'width: ' + progressPercent + '%'">
                            <!-- Shimmer effect -->
                            <div class="absolute top-0 left-0 w-full h-full bg-white/20"></div>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-gray-500 mt-2 text-right"><span x-text="currentXp"></span> XP</p>
                </div>

                <!-- Level Up Banner -->
                <template x-if="isLevelUp">
                    <div x-transition:enter="transition-all ease-out duration-700"
                        x-transition:enter-start="opacity-0 translate-y-4 scale-90"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        class="w-full bg-gradient-to-r from-[#FF5D5D] to-[#FF8B8B] rounded-xl p-4 mb-6 shadow-md transform -rotate-1 hover:rotate-1 transition">
                        <div class="flex items-center justify-center gap-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 text-white animate-bounce">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span
                                class="text-white font-black text-xl italic drop-shadow-sm tracking-wider uppercase">Level
                                Up!</span>
                        </div>
                        <p class="text-white/90 text-sm font-bold">Selamat! Kamu sekarang mencapai Level <span
                                x-text="currentLevel"></span></p>
                    </div>
                </template>
            </div>
        </div>
    @endif
</div>
