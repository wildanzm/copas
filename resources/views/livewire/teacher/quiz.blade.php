<div class="px-6 py-8 md:px-12 md:py-10 max-w-7xl mx-auto">

    <!-- Top Blue Container with Header & Stats -->
    <div class="bg-[#2D74DB] rounded-2xl p-6 md:p-8 mb-6 shadow-md">
        <!-- Header Title -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-white tracking-widest">KUIS</h1>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Rata-Rata Waktu Selesai -->
            <div class="bg-white rounded-xl p-5 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Rata-Rata Waktu Selesai</p>
                    <p class="text-2xl font-extrabold text-black">{{ $averageTime }}</p>
                </div>
                <div class="rounded-full p-2 border-2 border-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                </div>
            </div>

            <!-- Rata-Rata Nilai -->
            <div class="bg-white rounded-xl p-5 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Rata-Rata Nilai</p>
                    <p class="text-2xl font-extrabold text-black">{{ $averageScore }}</p>
                </div>
                <div class="rounded-full p-2 border-2 border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
            </div>

            <!-- Nilai Terendah -->
            <div class="bg-white rounded-xl p-5 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Nilai Terendah</p>
                    <p class="text-2xl font-extrabold text-black">{{ $lowestScore }}</p>
                </div>
                <div class="rounded-full p-2 border-2 border-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6 text-orange-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
            </div>

            <!-- Nilai Tertinggi -->
            <div class="bg-white rounded-xl p-5 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-1">Nilai Tertinggi</p>
                    <p class="text-2xl font-extrabold text-black">{{ $highestScore }}</p>
                </div>
                <div class="rounded-full p-2 border-2 border-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6 text-orange-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Bank Soal Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-4 flex items-center justify-between">
        <h2 class="text-lg font-medium text-gray-700 ml-2">Bank Soal</h2>
        <a href="{{ route('teacher.bank-soal') }}"
            class="px-6 py-2 bg-[#5B9BD5] hover:bg-blue-600 transition text-white font-semibold rounded-lg shadow-sm text-sm">
            LIHAT SOAL
        </a>
    </div>

    <!-- Students Answer Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Desktop Table (Hidden on Mobile) -->
        <div class="hidden md:block overflow-x-auto p-4">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-100">
                        <th class="px-4 py-4 text-left text-sm font-bold text-gray-800">Name</th>
                        <th class="px-4 py-4 text-center text-sm font-bold text-gray-800">Waktu</th>
                        <th class="px-4 py-4 text-center text-sm font-bold text-gray-800">Nilai</th>
                        <th class="px-4 py-4 text-left text-sm font-bold text-gray-800">Jawaban</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($studentAnswers as $student)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors">
                            <!-- Student Name with Avatar -->
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full overflow-hidden shrink-0 {{ !$student['avatar'] ? 'bg-[#2B73CA] p-1.5' : '' }}">
                                        @if ($student['avatar'])
                                            <img src="{{ asset('storage/' . $student['avatar']) }}"
                                                alt="{{ $student['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('assets/icons/dashboard/profil.png') }}"
                                                alt="{{ $student['name'] }}" class="w-full h-full object-contain">
                                        @endif
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">{{ $student['name'] }}</span>
                                </div>
                            </td>
                            <!-- Time -->
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm font-medium text-gray-600">{{ $student['finish_time'] }}</span>
                            </td>
                            <!-- Score -->
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm border-b border-gray-300 pb-1 text-gray-600">
                                    {{ $student['score'] }}{{ $student['score'] !== '-' ? '%' : '' }}
                                </span>
                            </td>
                            <!-- Answer Bubbles -->
                            <td class="px-4 py-3">
                                @if ($student['has_answers'])
                                    <div class="flex flex-wrap gap-1.5 items-center">
                                        @foreach ($questions as $index => $question)
                                            @php
                                                $answer = $student['answers']->firstWhere('question_id', $question->id);
                                                $isCorrect = $answer && $answer->xp_earned > 0;
                                                $bgColor = $isCorrect ? 'bg-[#99CB3A]' : 'bg-white';
                                            @endphp
                                            <div
                                                class="flex items-center justify-center w-6 h-6 rounded-full {{ $bgColor }} border border-black text-black text-[10px] font-medium leading-none">
                                                {{ $index + 1 }}
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500 italic">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-gray-500 font-medium">
                                Belum ada siswa yang mengerjakan kuis
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Hidden on Desktop) -->
        <div class="block md:hidden p-4 space-y-4">
            @forelse($studentAnswers as $student)
                <div
                    class="border border-gray-100 rounded-lg p-4 shadow-sm {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 rounded-full overflow-hidden shrink-0 {{ !$student['avatar'] ? 'bg-[#2B73CA] p-1.5' : '' }}">
                            @if ($student['avatar'])
                                <img src="{{ asset('storage/' . $student['avatar']) }}" alt="{{ $student['name'] }}"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('assets/icons/dashboard/profil.png') }}"
                                    alt="{{ $student['name'] }}" class="w-full h-full object-contain">
                            @endif
                        </div>
                        <span class="text-base font-bold text-gray-800">{{ $student['name'] }}</span>
                    </div>

                    <div
                        class="flex justify-between items-center mb-4 bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                        <div class="text-center flex-1 border-r border-gray-200">
                            <p class="text-xs text-gray-500 font-medium mb-1">Waktu</p>
                            <p class="text-sm font-bold text-gray-800">{{ $student['finish_time'] }}</p>
                        </div>
                        <div class="text-center flex-1">
                            <p class="text-xs text-gray-500 font-medium mb-1">Nilai</p>
                            <p class="text-sm font-bold text-gray-800">
                                {{ $student['score'] }}{{ $student['score'] !== '-' ? '%' : '' }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-2">Jawaban</p>
                        @if ($student['has_answers'])
                            <div class="flex flex-wrap gap-1.5 items-center">
                                @foreach ($questions as $index => $question)
                                    @php
                                        $answer = $student['answers']->firstWhere('question_id', $question->id);
                                        $isCorrect = $answer && $answer->xp_earned > 0;
                                        $bgColor = $isCorrect ? 'bg-[#99CB3A]' : 'bg-white';
                                    @endphp
                                    <div
                                        class="flex items-center justify-center w-7 h-7 rounded-full {{ $bgColor }} border border-black text-black text-xs font-semibold leading-none">
                                        {{ $index + 1 }}
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <span class="text-sm text-gray-500 italic">-</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="py-12 text-center text-gray-500 font-medium border border-gray-100 rounded-lg">
                    Belum ada siswa yang mengerjakan kuis
                </div>
            @endforelse
        </div>
    </div>

</div>
