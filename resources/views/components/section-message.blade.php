@props(['eligible'])

<div>
    <div class="text-gray-600 dark:text-slate-400 text-center mt-8">
        @if($eligible)
        <p>
            Solo aceptamos
            <strong class="text-gray-600 dark:text-slate-200">{{ $participant }}</strong>
            por participante.
        </p>
        @endif

        @if($lastEntry)
        La última vez que envió sus respuestas <strong class="text-gray-600 dark:text-slate-200">{{ $lastEntry }}</strong>.
        @endif
    </div>
    
</div>