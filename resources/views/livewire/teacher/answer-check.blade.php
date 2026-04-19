<div class="p-3 sm:p-6 font-sans">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm relative p-5 sm:p-8 md:p-12 min-h-[80vh]">
        
        <!-- Close Button -->
        <a href="{{ route('teacher.classroom') }}" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold bg-[#F3F4F6] px-3 py-1.5 rounded-md text-sm transition-colors flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>

        <!-- Header -->
        <div class="mb-12 mt-2">
            <h2 class="text-sm md:text-base font-bold text-gray-800 tracking-wide">Nama : {{ $student->name }}</h2>
        </div>

        <!-- Tabs and Contents -->
        <div x-data="{ activeTab: 1 }" class="w-full">
            
            <!-- Tabs Navigation -->
            <div class="flex border-b border-gray-200 mb-8 overflow-x-auto overflow-y-hidden whitespace-nowrap scrollbar-hide shrink-0 gap-2 pb-px">
                @foreach($nodes as $node)
                <button 
                    @click="activeTab = {{ $node->order_index }}"
                    :class="activeTab === {{ $node->order_index }} ? 'border-[#2B73CA] text-[#2B73CA]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="px-6 py-3 font-bold text-sm transition-colors duration-200 border-b-2 focus:outline-none">
                    Kegiatan {{ $node->order_index }}
                </button>
                @endforeach
            </div>

            <!-- Tab Contents -->
            <div class="min-h-[40vh]">
                @foreach($nodes as $node)
                <div x-show="activeTab === {{ $node->order_index }}" x-cloak style="display: none;" class="flex flex-col gap-5">
                    <h3 class="font-bold text-gray-800 text-sm md:text-[15px] uppercase tracking-wide mb-2">{{ $node->title }}</h3>

                    @if($node->order_index == 2)
                        <!-- True/False format -->
                        <div class="rounded-lg overflow-hidden mt-2">
                            <table class="w-full text-left text-sm md:text-sm bg-[#F3F8FD]">
                                <thead class="bg-[#E8F2FC]">
                                    <tr>
                                        <th class="py-3 px-6 font-bold text-gray-700 w-3/4">Pertanyaan</th>
                                        <th class="py-3 px-6 font-bold text-gray-700 text-center">Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white">
                                    @forelse($node->questions as $question)
                                        @php $ans = $answers->get($question->id); @endphp
                                        <tr class="even:bg-[#E8F2FC] odd:bg-[#F3F8FD]">
                                            <td class="py-4 px-6 text-gray-700 font-medium pr-12">{{ $question->content }}</td>
                                            <td class="py-4 px-6 text-center">
                                                @if($ans)
                                                    @if(strtolower($ans->answer_text) === 'benar')
                                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-bold bg-[#A3D977] text-white tracking-widest shadow-sm">Benar</span>
                                                    @elseif(strtolower($ans->answer_text) === 'salah')
                                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-bold bg-[#F98E8E] text-white tracking-widest shadow-sm">Salah</span>
                                                    @else
                                                        <!-- Optional default badge if they put something else -->
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[#7B8B9E] font-bold">{{ $ans->answer_text }}</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400 text-xs italic">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="py-4 text-center text-gray-400">Belum ada pertanyaan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Open Ended format -->
                        <div class="space-y-10 mt-2">
                            @foreach($node->questions as $index => $question)
                                @php $ans = $answers->get($question->id); @endphp
                                <div class="flex flex-col gap-2">
                                    <!-- Specifically for Node 3 that has an image -->
                                    @if($node->order_index == 3 && $index == 0 && $ans && $ans->file_path)
                                        <div class="w-full flex justify-center mb-6">
                                            <div class="border-[6px] border-white shadow-md bg-white p-1">
                                                <img src="{{ asset('storage/' . $ans->file_path) }}" class="max-h-72 object-cover" alt="Observasi Siswa">
                                            </div>
                                        </div>
                                        <h4 class="font-bold text-gray-800 text-sm mt-2">Penjelasan</h4>
                                    @else
                                        <p class="text-gray-800 text-sm font-medium">{{ $question->content }}</p>
                                        <h4 class="text-[10px] text-[#A6AFBA] font-semibold italic mt-3 mb-1">Hasil Jawaban</h4>
                                    @endif
                                    
                                    <div class="text-[#515F70] text-sm">
                                        {{ $ans ? $ans->answer_text : 'Siswa belum menjawab.' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
