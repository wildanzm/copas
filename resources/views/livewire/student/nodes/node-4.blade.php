<div class="bg-copas-light text-copas-dark p-6 rounded-xl shadow-sm">
    <h2 class="text-2xl font-bold mb-6">{{ $node->title }}</h2>

    @foreach ($node->questions as $question)
        <div class="mb-6">
            <p class="text-lg mb-4 text-center">{{ $question->text }}</p>
            <div class="flex justify-center gap-6">
                @foreach ($question->options as $option)
                    <button
                        class="px-8 py-4 bg-white border-2 border-gray-200 rounded-xl hover:border-copas-dark hover:bg-gray-50 transition-all font-bold">
                        {{ $option->text }}
                    </button>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
