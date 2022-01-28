<div>
    <div class="text-gray-600 dark:text-slate-400 text-center mt-8">
        @isset($participant)
        <p>
            Solo aceptamos
            <strong class="text-gray-600 dark:text-slate-200">{{ $participant }}</strong>
            por participante.
        </p>
        @endisset

        @isset($lastEntry)
        La última vez que envió sus respuestas <strong class="text-gray-600 dark:text-slate-200">{{ $lastEntry }}</strong>.
        @endisset
    </div>
    
</div>