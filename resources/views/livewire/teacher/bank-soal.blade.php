<div class="p-6 md:p-8 max-w-5xl mx-auto min-h-screen bg-[#E5F3FF]" x-data="{
    confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Soal yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.deleteQuestion(id);
            }
        });
    }
}">

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <!-- Header Controls -->
    <div class="bg-white rounded-xl shadow-sm p-4 flex flex-col sm:flex-row justify-between items-center mb-6">
        <div class="flex items-center gap-3 mb-4 sm:mb-0">
            <span class="text-sm font-semibold text-gray-700">Waktu :</span>
            <input type="text" wire:model="quizTime"
                class="border border-gray-300 rounded px-3 py-1.5 text-sm w-24 text-gray-700 focus:outline-none focus:border-blue-500"
                placeholder="20:00">
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('teacher.quiz') }}"
                class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-white font-medium rounded-lg text-sm transition">
                KEMBALI
            </a>
            <button wire:click="addQuestion"
                class="px-6 py-2 bg-[#5B9BD5] hover:bg-blue-600 text-white font-medium rounded-lg text-sm transition shadow-sm">
                TAMBAH SOAL
            </button>
            <button wire:click="saveAll"
                class="px-6 py-2 bg-[#5B9BD5] hover:bg-blue-600 text-white font-medium rounded-lg text-sm transition shadow-sm">
                SIMPAN
            </button>
        </div>
    </div>

    <!-- Question Cards -->
    <div class="space-y-8">
        @foreach ($questions as $index => $question)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 group relative">
                <!-- Action Bar (Top Right) -->
                <div class="absolute top-3 right-3 flex items-center gap-2 z-20 opacity-0 group-hover:opacity-100 transition-opacity">
                    <!-- Upload Image Button -->
                    <label class="cursor-pointer bg-white shadow-sm p-2 rounded-lg border border-gray-200 hover:bg-blue-50 hover:text-blue-600 transition group/upload">
                        <input type="file" wire:model="tempImages.{{ $question['id'] }}" class="hidden" accept="image/*">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0z" />
                        </svg>
                        <span class="absolute right-full mr-2 px-2 py-1 bg-gray-800 text-white text-[10px] rounded opacity-0 group-hover/upload:opacity-100 whitespace-nowrap pointer-events-none transition">Upload Gambar</span>
                    </label>

                    <!-- Delete Button -->
                    <button @click="confirmDelete({{ $question['id'] }})"
                        class="bg-white shadow-sm p-2 rounded-lg border border-gray-200 text-red-500 hover:bg-red-50 hover:text-red-600 transition group/del">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <span class="absolute right-full mr-2 px-2 py-1 bg-gray-800 text-white text-[10px] rounded opacity-0 group-hover/del:opacity-100 whitespace-nowrap pointer-events-none transition">Hapus Soal</span>
                    </button>
                </div>

                <div class="p-6 md:p-8 pt-10 md:pt-12">
                    <!-- Main Content Area -->
                    <div class="flex flex-col gap-6">
                        <!-- Image Section -->
                        @if ($question['image_path'])
                            <div class="w-full mb-6 group/img-box" style="text-align: {{ $question['image_settings']['position'] }}">
                                <!-- Image Toolbar (In-flow) -->
                                <div class="inline-flex items-center gap-1 bg-white shadow-lg rounded-full px-4 py-2 border border-gray-200 mb-4 opacity-0 group-hover/img-box:opacity-100 transition-all transform scale-95 group-hover/img-box:scale-100 z-30 relative" style="background-color: #ffffff !important;">
                                    <!-- Position Controls -->
                                    <div class="flex items-center gap-0.5">
                                        <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'], ['position' => 'left'])) }})" 
                                            class="p-1.5 rounded hover:bg-gray-100 {{ $question['image_settings']['position'] === 'left' ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}" title="Rata Kiri">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" /></svg>
                                        </button>
                                        <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'], ['position' => 'center'])) }})" 
                                            class="p-1.5 rounded hover:bg-gray-100 {{ $question['image_settings']['position'] === 'center' ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}" title="Rata Tengah">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                                        </button>
                                        <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'], ['position' => 'right'])) }})" 
                                            class="p-1.5 rounded hover:bg-gray-100 {{ $question['image_settings']['position'] === 'right' ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }}" title="Rata Kanan">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" class="rotate-180 origin-center" /></svg>
                                        </button>
                                    </div>
                                    
                                    <div class="w-px h-4 bg-gray-200 mx-1"></div>
                                    
                                    <!-- Size Controls -->
                                    <div class="flex items-center gap-1">
                                        <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'], ['width' => max(10, $question['image_settings']['width'] - 10)])) }})" 
                                            class="p-1.5 rounded hover:bg-gray-100 text-gray-600" title="Kecilkan">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" /></svg>
                                        </button>
                                        <span class="text-[10px] font-bold w-8 text-center text-gray-700">{{ $question['image_settings']['width'] }}%</span>
                                        <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'], ['width' => min(100, $question['image_settings']['width'] + 10)])) }})" 
                                            class="p-1.5 rounded hover:bg-gray-100 text-gray-600" title="Besarkan">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                        </button>
                                    </div>
                                    
                                    <div class="w-px h-4 bg-gray-200 mx-1"></div>
                                    
                                    <!-- Rotate Control -->
                                    <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'], ['rotation' => ($question['image_settings']['rotation'] + 90) % 360])) }})" 
                                        class="p-1.5 rounded hover:bg-gray-100 text-gray-600" title="Putar 90°">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                                    </button>
                                    
                                    <div class="w-px h-4 bg-gray-200 mx-1"></div>
                                    
                                    <!-- Remove Image -->
                                    <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'], ['remove' => true])) }})" 
                                        class="p-1.5 rounded hover:bg-red-50 text-red-500" title="Hapus Gambar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>

                                <!-- Image Display -->
                                <div class="w-full relative z-10">
                                    <div class="relative inline-block overflow-visible" style="width: {{ $question['image_settings']['width'] }}%;">
                                        <img src="{{ asset('storage/' . $question['image_path'] ) }}" 
                                             class="w-full h-auto rounded-xl border border-gray-200 transition-all duration-300"
                                             style="transform: rotate({{ $question['image_settings']['rotation'] }}deg);"
                                             alt="Question image">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Question Content -->
                        <div class="w-full">
                            <div contenteditable="true"
                                wire:blur="updateQuestionContent({{ $question['id'] }}, $event.target.innerHTML)"
                                class="w-full text-lg md:text-xl text-gray-800 bg-transparent border-0 focus:ring-0 focus:outline-none rounded p-2 overflow-hidden prose max-w-none"
                                data-placeholder="Tulis pertanyaan di sini...">{!! $question['content'] !!}</div>
                        </div>

                        <!-- Options -->
                        <div class="space-y-4 pt-4 border-t border-gray-50">
                            @foreach ($question['options'] as $option)
                                <div class="flex items-start gap-4">
                                    <button wire:click="setCorrectOption({{ $question['id'] }}, {{ $option['id'] }})"
                                        class="shrink-0 flex items-center justify-center w-6 h-6 mt-1.5 rounded-full border-2 transition-colors {{ $option['is_correct'] ? 'border-blue-600 bg-blue-600' : 'border-gray-300 hover:border-gray-400' }}">
                                        @if ($option['is_correct'])
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-white">
                                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </button>
                                    <div contenteditable="true"
                                        wire:blur="updateOptionText({{ $option['id'] }}, $event.target.innerHTML)"
                                        class="flex-1 text-base md:text-lg text-gray-700 bg-transparent border-0 focus:ring-0 focus:outline-none rounded px-2 py-1 prose-sm max-w-none">
                                        {!! $option['text'] !!}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('swal:alert', event => {
            Swal.fire({
                icon: event.detail[0].icon,
                title: event.detail[0].title,
                text: event.detail[0].text,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        });
    </script>
</div>
