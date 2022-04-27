<div>
    <x-jet-secondary-button wire:click="confirmUpdateQuestion" wire:loading.attr="disabled">
        {{ __('Editar') }}
    </x-jet-secondary-button>

    <!-- Edit Question Modal -->
    <x-jet-dialog-modal wire:model="confirmingUpdateQuestion">
    <x-slot name="title">
        {{ __('Editar pregunta') }}: {{ $question->id }}
    </x-slot>

    <x-slot name="content">
        <span class="font-semibold">Tipo de pregunta "{{ $question->type }}"</span>

        <div class="mt-4">
            <x-jet-label for="content" value="Titulo de la pregunta"/>

            <textarea name="content" wire:model="state.content" class="mt-1 block w-3/4 h-32 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

            <x-jet-input-error for="content" class="mt-2" />
        </div>

        @if('radio' == $question->type)
        <div class="mt-4">
            <x-jet-label for="options" value="Opciones"/>
            <div class="space-y-2"> 
                @foreach ($this->state['options'] as $key => $option)
                <div class="flex items-center space-x-2">
                    <x-jet-input type="text" name="options" class="mt-1 block w-3/4" wire:model="state.options.{{ $key }}"/>
                    <div wire:click="removeOption({{ $key }})" class="mt-1 block w-1/4 text-sm text-red-500 hover:text-red-700 cursor-pointer">Eliminar</div>
                </div>
                @endforeach

                <x-jet-secondary-button wire:click="addOption">
                    {{ __('Agregar mas opciones') }}
                </x-jet-secondary-button>
            </div>
        </div>
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingUpdateQuestion')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-3"
                    wire:click="updateQuestion"
                    wire:loading.attr="disabled">
            {{ __('Editar pregunta') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
</div>
