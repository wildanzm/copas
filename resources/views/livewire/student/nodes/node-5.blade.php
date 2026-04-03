<div class="bg-copas-light text-copas-dark p-6 rounded-xl shadow-sm">
    <h2 class="text-2xl font-bold mb-6">{{ $node->title }}</h2>

    @foreach ($node->questions as $question)
        <div class="mb-6 flex flex-col gap-4">
            <label class="text-lg font-semibold">{{ $question->text }}</label>
            <textarea rows="6"
                class="w-full p-4 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-copas-dark"
                placeholder="Tuliskan jawaban esaimu di sini..."></textarea>
            <button
                class="self-end px-6 py-3 bg-[#1056A4] text-white font-bold rounded-xl hover:bg-blue-800 transition-colors">
                Kirim Jawaban
            </button>
        </div>
    @endforeach
</div>
