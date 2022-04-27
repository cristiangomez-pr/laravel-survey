<x-jet-action-section>
    <x-slot name="title">
        {{ __('Preguntas de la encuesta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Puede agregar o eliminar preguntas, pero asegúrese de no eliminarlas si la encuesta ya se lleno.') }}
    </x-slot>

    <x-slot name="content">
        <div class="flex items-center mb-5">
            <x-jet-secondary-button wire:click="confirmCreateQuestion" wire:loading.attr="disabled">
                {{ __('Agregar pregunta') }}
            </x-jet-secondary-button>
        </div>

        <div class="mt-5 space-y-6">
            @foreach ($this->questions as $question)
                <div class="flex items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="ml-3 w-full flex items-center justify-between">
                        <div class="text-sm text-gray-600 mr-3">
                            {{ $question->content }}

                            <div class="text-xs text-gray-500">
                                <span class="font-semibold">Tipo: {{ $question->type }}</span>, {{ $question->created_at->diffForHumans() }}
                            </div>
                        </div>

                        <div class="inline-flex space-x-4 items-center">
                            <livewire:question-survey-update-form :question="$question" :key="$question->id"/>
                            <x-jet-secondary-button class="text-red-500 hover:text-red-400 border-red-300" onclick="confirm('¿Está seguro de que desea eliminar esta pregunta?') || event.stopImmediatePropagation()" wire:click="deleteQuestion({{ $question->id }})">Eliminar</x-jet-secondary-button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Question Modal -->
        <x-jet-dialog-modal wire:model="confirmingCreateQuestion">
            <x-slot name="title">
                {{ __('Agregar una nueva pregunta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Asegúrese de elegir un tipo de pregunta para continuar.') }}

                <div class="mt-4">
                    <select wire:model="type" class="block w-3/4 mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="text">Texto</option>
                        <option value="number">Numerico</option>
                        <option value="radio">Selecion unica</option>
                        <option value="multiselect">Selecion multiple</option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-jet-label for="content" value="Titulo de la pregunta"/>
                    <textarea name="content" wire:model="state.content" class="mt-1 block w-3/4 h-32 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

                    <x-jet-input-error for="content" class="mt-2" />
                </div>

                @if(in_array($type, ['radio', 'multiselect']))
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
                <x-jet-secondary-button wire:click="$toggle('confirmingCreateQuestion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-3"
                            wire:click="addQuestion"
                            wire:loading.attr="disabled">
                    {{ __('Agregar pregunta') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>