<?php

namespace MattDaneshvar\Survey\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateSurveyForm extends Component
{  
    public $survey;

    public $state = [];

    public function mount($survey)
    {
        $this->survey = $survey;

        $this->state = [
            'name' => $survey->name,
            'guest' => data_get($survey->settings, 'accept-guest-entries'),
            'limit' => data_get($survey->settings, 'limit-per-participant') == 1 ? true : false,
        ];
    }

    public function updateSurvey()
    {
        Validator::make($this->state, [
            'name' => 'required|string|min:10|max:100'
        ])->validate();

        $this->survey->update([
            'name' => $this->state['name'],
            'settings' => [
                'accept-guest-entries' => (bool) $this->state['guest'],
                'limit-per-participant' => ((bool) $this->state['limit']) ? 1 : -1,
            ]
        ]);

        $this->emit('saved');
    }

    public function render()
    {
        return view('survey::survey.update-survey-form');
    }
}
