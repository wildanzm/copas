<div class="bg-copas-light text-copas-dark p-6 rounded-xl shadow-sm">
    <h2 class="text-2xl font-bold mb-6">{{ $node->title }}</h2>

    @foreach ($node->questions as $question)
        <div class="mb-6">
            <p class="text-lg mb-4">{{ $question->text }}</p>
            <div class="flex flex-col gap-3">
                @foreach ($question->options as $option)
                    <label
                        class="flex items-center gap-3 p-4 bg-white rounded-lg border cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="answer_{{ $question->id }}" value="{{ $option->id }}"
                            class="w-5 h-5 text-copas-dark">
                        <span>{{ $option->text }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
