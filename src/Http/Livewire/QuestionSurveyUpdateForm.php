<?php

namespace MattDaneshvar\Survey\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class QuestionSurveyUpdateForm extends Component
{  
    public $confirmingUpdateQuestion = false;

    public $question;

    public $state = [];

    public function mount($question)
    {
        $this->question = $question;

        $this->state = [
            'content' => $question->content,
            'options' => is_array($question->options) ? $question->options : [],
        ];
    }

    public function confirmUpdateQuestion()
    {
        $this->confirmingUpdateQuestion = true;
    }

    public function updateQuestion()
    {
        Validator::make($this->state, [
            'content' => ['required', 'string', 'min:20', 'max:255'],
            'options' => [Rule::requiredIf($this->question->type == 'radio'), 'array']
        ])->validate();

        if (! in_array($this->question->type, ['radio', 'multiselect'])) {
           $this->question->update([
               'content' => $this->state['content']
           ]);
        }
        
        if (in_array($this->question->type, ['radio', 'multiselect'])) {
            $this->question->update([
                'content' => $this->state['content'],
                'options' => array_filter($this->state['options'])
            ]);
        }
        
        $this->emit('refresh-question-survey-form');
        
        $this->confirmingUpdateQuestion = false;
    }

    public function addOption()
    {
        array_push($this->state['options'], null);
    }

    public function removeOption($key)
    {
        $this->state['options'] = collect($this->state['options'])->filter(fn ($option, $index) => $index <> $key)->values();
    }

    public function render()
    {
        return view('survey::survey.question-survey-update-form');
    }
}
