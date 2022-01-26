<x-survey-question-base :question="$question">
    <x-survey-input 
        autocomplete="off" 
        type="text" 
        name="{{ $question->key }}" 
        id="{{ $question->key }}" 
        value="{{ $value ?? old($question->key) }}" 
        :disabled="$disabled ?? false"
    />
</x-survey-question-base>