<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Encuestas') }}
            </h2>
            <x-jet-secondary-button onClick="window.location.href = '{{ route('surveys.create') }}'">Crear</x-jet-secondary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:survey-search/>
        </div>
    </div>
</x-app-layout>
