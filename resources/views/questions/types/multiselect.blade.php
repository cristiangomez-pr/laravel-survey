<x-survey-question-base :question="$question">
@foreach ($question->options as $option)
    <div class="flex items-start">
        <div class="flex items-center h-5">
            <input type="checkbox"
                name="{{ $question->key }}[]"
                id="{{ $question->key . '-' . Str::slug($option) }}"
                value="{{ $option }}"
                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                    {{ ($value ?? old($question->key)) == $option ? 'checked' : '' }}
                    {{ ($disabled ?? false) ? 'disabled' : '' }}
            >
        </div>
        <div class="ml-3 text-sm">
            <label class="font-medium text-gray-700"
                for="{{ $question->key . '-' . Str::slug($option) }}">{{ $option }}
            </label>
        </div>
    </div>
@endforeach
</x-survey-question-base>