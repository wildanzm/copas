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
    <div class="bg-white rounded-lg shadow-sm px-6 py-4 flex justify-between items-center mb-6">
        <div class="text-sm text-gray-700 flex items-center">
            Waktu : 20:00
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('teacher.quiz') }}"
                class="px-5 py-1.5 bg-[#cfcfcf] text-white text-xs font-semibold rounded-md hover:bg-gray-400 transition">
                KEMBALI
            </a>
            <button wire:click="saveAll"
                class="px-5 py-1.5 bg-[#5B9BD5] text-white text-xs font-semibold rounded-md hover:bg-blue-600 transition">
                SIMPAN
            </button>
        </div>
    </div>

    <!-- Question Cards -->
    <div class="space-y-6">
        @foreach ($questions as $index => $question)
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 md:p-8 relative group">
                <!-- Action Bar (Top Right) -->
                <div class="absolute top-6 right-6 flex items-center gap-3 z-20">
                    <!-- Delete Button (Hidden by default to match image, shows on hover) -->
                    <button @click="confirmDelete({{ $question['id'] }})"
                        class="text-red-500 hover:text-red-700 opacity-0 group-hover:opacity-100 transition-opacity bg-white/80 p-1 rounded" title="Hapus Soal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>

                    <!-- Upload Image Button (Matches Image exactly) -->
                    <label class="cursor-pointer text-gray-500 hover:text-gray-700 transition">
                        <input type="file" wire:model="tempImages.{{ $question['id'] }}" class="hidden" accept="image/*">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </label>
                </div>

                <!-- Main Content Area -->
                <div class="flex flex-col gap-6">
                    <!-- Image Section (if uploaded) -->
                    @if ($question['image_path'])
                        <div class="w-full mb-4 group/img-box" style="text-align: {{ $question['image_settings']['position'] ?? 'center' }}">
                            <!-- Image Toolbar (In-flow, hidden by default) -->
                            <div class="inline-flex flex-wrap items-center gap-1 bg-white shadow-lg rounded-full px-3 py-1.5 border border-gray-200 mb-2 opacity-0 group-hover/img-box:opacity-100 transition-all z-30 relative mx-auto">
                                <div class="flex items-center gap-0.5">
                                    <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'] ?? [], ['position' => 'left'])) }})" class="p-1 hover:bg-gray-100 rounded text-gray-600"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg></button>
                                    <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'] ?? [], ['position' => 'center'])) }})" class="p-1 hover:bg-gray-100 rounded text-gray-600"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button>
                                    <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'] ?? [], ['position' => 'right'])) }})" class="p-1 hover:bg-gray-100 rounded text-gray-600"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M13 18h7"/></svg></button>
                                </div>
                                <div class="w-px h-4 bg-gray-200 mx-1"></div>
                                <div class="flex items-center gap-1">
                                    <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'] ?? [], ['width' => max(10, ($question['image_settings']['width'] ?? 100) - 10)])) }})" class="p-1 hover:bg-gray-100 rounded text-gray-600"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg></button>
                                    <span class="text-[10px] w-6 text-center">{{ $question['image_settings']['width'] ?? 100 }}%</span>
                                    <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'] ?? [], ['width' => min(100, ($question['image_settings']['width'] ?? 100) + 10)])) }})" class="p-1 hover:bg-gray-100 rounded text-gray-600"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg></button>
                                </div>
                                <div class="w-px h-4 bg-gray-200 mx-1"></div>
                                <button wire:click="updateImageSettings({{ $question['id'] }}, {{ json_encode(array_merge($question['image_settings'] ?? [], ['remove' => true])) }})" class="p-1 hover:bg-red-50 rounded text-red-500"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>

                            <div class="w-full relative z-10">
                                <div class="relative inline-block overflow-visible" style="width: {{ $question['image_settings']['width'] ?? 100 }}%;">
                                    <img src="{{ asset('storage/' . $question['image_path'] ) }}" 
                                         class="w-full h-auto rounded-lg transition-all duration-300"
                                         style="transform: rotate({{ $question['image_settings']['rotation'] ?? 0 }}deg);"
                                         alt="Question image">
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Question Content -->
                    <div class="pr-16">
                        <div contenteditable="true"
                            wire:blur="updateQuestionContent({{ $question['id'] }}, $event.target.innerHTML)"
                            class="w-full text-[17px] text-[#111] bg-transparent border-0 focus:ring-0 focus:outline-none wrap-break-word max-w-none font-sans leading-relaxed"
                            data-placeholder="Tulis pertanyaan di sini...">{!! $question['content'] !!}</div>
                    </div>

                    <!-- Options -->
                    <div class="space-y-4 mt-2">
                        @foreach ($question['options'] as $option)
                            <div class="flex items-center gap-3">
                                <button wire:click="setCorrectOption({{ $question['id'] }}, {{ $option['id'] }})"
                                    class="shrink-0 flex items-center justify-center transition-colors">
                                    @if ($option['is_correct'])
                                        <!-- Active Radio (Matches Image) -->
                                        <div class="w-[22px] h-[22px] rounded-full border-[2.5px] border-gray-600 flex items-center justify-center">
                                            <div class="w-[10px] h-[10px] rounded-full bg-[#111]"></div>
                                        </div>
                                    @else
                                        <!-- Inactive Radio -->
                                        <div class="w-[22px] h-[22px] rounded-full border-[2.5px] border-gray-400"></div>
                                    @endif
                                </button>
                                <div contenteditable="true"
                                    wire:blur="updateOptionText({{ $option['id'] }}, $event.target.innerHTML)"
                                    class="flex-1 text-[17px] text-[#111] bg-transparent border-0 focus:ring-0 focus:outline-none wrap-break-word max-w-none font-sans">
                                    {!! $option['text'] !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Question Button (Moved to bottom) -->
    <div class="mt-8 flex justify-center pb-8">
        <button wire:click="addQuestion"
            class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg text-sm hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Soal
        </button>
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
