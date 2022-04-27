<?php

namespace MattDaneshvar\Survey\Http\Controllers;

use Illuminate\Http\Request;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Models\Survey;

class SurveysController extends Controller
{
    public function show(Request $request, Survey $survey)
    {
        abort_unless($survey->questions->count(), '403', 'Lo sentimos, esta encuesta no está lista para ser completada');

        return view('survey::standard', ['survey' => $survey]);
    }

    public function store(Request $request, Survey $survey)
    {
        $answers = $request->validate($survey->rules);

        (new Entry())->for($survey)->by($request->user())->fromArray($answers)->push();

        return redirect()->route('surveys.start', $survey->slug)->withSuccess('Encuesta completada con éxito.');
    }
}
