<x-jet-form-section submit="updateSurvey">
    <x-slot name="title">
        {{ __('Información de la encuesta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualizar la encuesta, asegúrese de configurarla correctamente.') }}
    </x-slot>

    <x-slot name="form">    
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nombre') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Setting -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="setting" value="{{ __('Configuraciones') }}" />
            <label for="state.guest" class="flex items-center">
                <x-survey-checkbox wire:model.defer="state.guest" id="state.guest" name="state.guest"/>
                <span class="ml-2 text-sm text-gray-600">Permitir que los anonimos puedan llenar la encuesta</span>
            </label>
            <label for="state.limit" class="flex items-center">
                <x-survey-checkbox wire:model.defer="state.limit" id="state.limit" name="state.limit"/>
                <span class="ml-2 text-sm text-gray-600">Limitar a solo una encuesta por persona</span>
            </label>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Actualizado') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled">
            {{ __('Actualizar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>