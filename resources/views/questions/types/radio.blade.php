<x-survey-question-base :question="$question">
    @foreach($question->options as $option)
        <div class="flex items-center">
            <input type="radio"
                   name="{{ $question->key }}"
                   id="{{ $question->key . '-' . Str::slug($option) }}"
                   value="{{ $option }}"
                   class="focus:ring-blue-500 dark:focus:ring-0 h-4 w-4 text-blue-600 border-gray-300"
                    {{ ($value ?? old($question->key)) == $option ? 'checked' : '' }}
                    {{ ($disabled ?? false) ? 'disabled' : '' }}
            >
            <label class="ml-3 block text-sm font-medium text-slate-800 dark:text-slate-100"
                   for="{{ $question->key . '-' . Str::slug($option) }}">{{ $option }}
                @if($includeResults ?? false)
                    <span class="text-green-700">
                        ({{ number_format((new \MattDaneshvar\Survey\Utilities\Summary($question))->similarAnswersRatio($option) * 100, 2) }}%)
                    </span>
                @endif
            </label>
        </div>
    @endforeach
</x-survey-question-base>