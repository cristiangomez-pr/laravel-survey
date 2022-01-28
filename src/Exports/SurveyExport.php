<?php

namespace MattDaneshvar\Survey\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use MattDaneshvar\Survey\Models\Survey;

class SurveyExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function __construct(
        public Survey $survey
    ){}

    public function collection()
    {
        $users = User::toBase()
            ->select('id', 'name')
            ->whereIn('id', $this->survey->entries->map->participant_id)
            ->get();

        $authors = $this->survey
            ->entries
            ->map(fn ($entry) => [
                'name' => $users->first(fn ($user) => $entry->participant_id == $user->id)?->name,
                'created_at' => $entry->created_at->format('Y-m-d')
            ]);

        $answers = $this->survey
            ->questions()
            ->select('id', 'content')
            ->with('answers:question_id,value')
            ->get()
            ->pluck('answers')
            ->map(fn ($answers) => $answers->map(fn ($answer) => $answer->value));

        return collect($authors->pluck('name'))
            ->zip($authors->pluck('created_at'), ...$answers);
    }

    public function headings(): array
    {
        return collect(['Participante', 'Fecha de llenado'])
            ->merge($this->survey->questions->map->content)
            ->toArray();
    }
}