<?php

namespace MattDaneshvar\Survey\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use MattDaneshvar\Survey\Models\Survey;

class SurveySearch extends Component
{
    use WithPagination;

    public $search;
 
    protected $queryString = ['search' => ['except' => '']];
    
    public function getSurveysProperty()
    {
        return Survey::query()
            ->withCount(['questions', 'entries'])
            ->when($this->search, fn ($query, $search) => 
                $query->where('name', 'like', '%'.$search.'%')
            )
            ->latest()
            ->paginate()
            ->through(fn ($survey) => [
                'id' => $survey->id,
                'name' => $survey->name,
                'slug' => $survey->slug,
                'questions_count' => $survey->questions_count,
                'entries_count' => $survey->entries_count,
                'updated_at' => $survey->updated_at->diffForHumans(),
            ]);
    }

    public function render()
    {
        return view('survey::livewire.survey-search');
    }
}
