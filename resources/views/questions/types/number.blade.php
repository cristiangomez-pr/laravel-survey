<x-survey-question-base :question="$question">
    <x-survey-input 
        autocomplete="off" 
        type="number" 
        name="{{ $question->key }}" 
        id="{{ $question->key }}" 
        value="{{ $value ?? old($question->key) }}" 
        :disabled="$disabled ?? false"
    />

    <x-slot name="report">
        @if($includeResults ?? false)
            {{ number_format((new \MattDaneshvar\Survey\Utilities\Summary($question))->average()) }} (Promedio)
        @endif
    </x-slot>
</x-survey-question-base>