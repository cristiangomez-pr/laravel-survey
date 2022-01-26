<div class="flex flex-col space-y-2">
    <label class="block text-sm font-[650] text-slate-700 dark:text-slate-200" for="{{ $question->key }}">{{ $question->content }}</label>
    {{ $slot }}
    @if($errors->has($question->key))
        <div class="text-red-600 dark:text-red-400 text-sm">{{ $errors->first($question->key) }}</div>
    @endif
</div>

<div class="text-green-700 text-sm mt-1">
    {{ $report ?? '' }}    
</div>