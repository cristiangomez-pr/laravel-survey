<?php

namespace MattDaneshvar\Survey\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use MattDaneshvar\Survey\Models\Question;

class QuestionSurveyForm extends Component
{  
    protected $listeners = [
        'refresh-question-survey-form' => '$refresh',
    ];

    public $confirmingCreateQuestion = false;

    public $survey;

    public $type;

    public $state = [
        'options' => []
    ];

    public function mount($survey)
    {
        $this->survey = $survey;
    }

    public function confirmCreateQuestion()
    {
        $this->state = [
            'options' => []
        ];

        $this->confirmingCreateQuestion = true;
    }

    public function addQuestion()
    {
        Validator::make($this->state, [
            'content' => ['required', 'string', 'min:20', 'max:255'],
            'options' => [Rule::requiredIf($this->type == 'radio'), 'array']
        ])->validate();

       if ('text' == $this->type) {
           $this->survey->questions()->create([
               'content' => $this->state['content']
           ]);
       }

       if (in_array($this->type, ['number', 'radio', 'multiselect'])) {
            $this->survey->questions()->create([
                'content' => $this->state['content'],
                'type' => $this->type,
                'options' => array_filter($this->state['options'])
            ]);
       }

        $this->emit('refresh-question-survey-form');
           
        $this->confirmingCreateQuestion = false;
    }

    public function addOption()
    {
        array_push($this->state['options'], null);
    }

    public function removeOption($key)
    {
        $this->state['options'] = collect($this->state['options'])->filter(fn ($option, $index) => $index <> $key)->values();
    }

    public function deleteQuestion($question_id)
    {
        if ($question = Question::find($question_id)) {
            $question->delete();

            $this->emit('refresh-question-survey-form');
        }
    }

    public function getQuestionsProperty()
    {
        return $this->survey->questions;
    }

    public function render()
    {
        return view('survey::survey.question-survey-form');
    }
}
