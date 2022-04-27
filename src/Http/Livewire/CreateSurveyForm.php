<?php

namespace MattDaneshvar\Survey\Http\Livewire;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use MattDaneshvar\Survey\Models\Survey;

class CreateSurveyForm extends Component
{  
    public $state = [];

    public function createNewSurvey()
    {
        Validator::make($this->state, [
            'name' => 'required|string|min:10|max:100'
        ])->validate();

        $survey = Survey::create([
            'name' => $this->state['name'],
            'settings' => [
                'accept-guest-entries' => (bool) data_get($this->state, 'guest'),
                'limit-per-participant' => data_get($this->state, 'limit') ? 1 : -1,
            ]
        ]);

        return redirect()->route('surveys.edit', $survey);
    }

    public function render()
    {
        return view('survey::survey.create-survey-form');
    }
}
