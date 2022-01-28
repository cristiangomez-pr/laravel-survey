<?php

namespace MattDaneshvar\Survey\Http\Controllers;

use MattDaneshvar\Survey\Models\Survey;
use MattDaneshvar\Survey\Exports\SurveyExport;

class AdminController extends Controller
{
    public function index()
    {
        return view('survey::admin');
    }

    public function export(Survey $survey)
    {
        return (new SurveyExport($survey))->download($survey->slug.'-'. now()->format('Ymdhm').'.xlsx');
    }
}
