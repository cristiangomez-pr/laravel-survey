<?php

namespace MattDaneshvar\Survey\Http\Controllers;

use App\Actions\Survey\BelongsToDomainGroup;
use MattDaneshvar\Survey\Models\Survey;
use MattDaneshvar\Survey\Exports\SurveyExport;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            fn ($request, $next) =>
            app()->isLocal() || app(BelongsToDomainGroup::class)->handle()
                ? $next($request)
                : abort(403, 'No tiene los privilegios para acceder a esta sección.')
        );
    }

    public function index()
    {
        return view('survey::survey.index');
    }

    public function create()
    {
        return view('survey::survey.create');
    }

    public function edit(Survey $survey)
    {
        return view('survey::survey.edit', [
            'survey' => $survey
        ]);
    }

    public function export(Survey $survey)
    {
        return (new SurveyExport($survey))->download($survey->slug.'-'. now()->format('Ymdhm').'.xlsx');
    }
}
