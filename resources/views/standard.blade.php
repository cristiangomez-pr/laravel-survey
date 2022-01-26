<x-survey-layout>
    <div class="bg-white dark:bg-slate-900  min-h-screen py-6 flex sm:py-12">
        <div class="max-w-screen-sm mx-auto">
            <x-survey-section-title>{{ $survey->name }}</x-survey-section-title>
            
            <x-survey-section-message :eligible="!$eligible">
                <x-slot name="participant">
                    {{ $survey->limitPerParticipant() }} {{ __(Str::plural('entry', $survey->limitPerParticipant())) }}
                </x-slot>

                <x-slot name="lastEntry">
                    {{ $lastEntry->created_at->diffForHumans() }}
                </x-slot>
            </x-survey-section-message>
            
            @if(!$survey->acceptsGuestEntries() && auth()->guest())
            <div class="text-center">
                Inicie sesión para unirse a esta encuesta.
            </div>
            @else
            <form class="pt-8 space-y-8" action="{{ route('survey.complete', $survey) }}" method="post">
                @csrf
                @foreach($survey->sections as $section)
                    @include('survey::sections.single')
                @endforeach
        
                @foreach($survey->questions()->withoutSection()->get() as $question)
                    @include('survey::questions.single')
                @endforeach
        
                @if($eligible)
                    <x-survey-button>Finalizar</x-survey-button>
                @endif
            </form>
            @endif
        </div>
    </div>
</x-survey-layout>