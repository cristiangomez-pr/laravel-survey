<?php

use Illuminate\Support\Facades\Route;
use MattDaneshvar\Survey\Http\Controllers\AdminController;
use MattDaneshvar\Survey\Http\Controllers\SurveysController;

Route::group(['middleware' => 'survey'], function () {
    Route::get('survey/{survey:slug}', [SurveysController::class, 'show'])->name('survey.start');
    Route::post('survey/{survey}', [SurveysController::class, 'store'])->name('survey.complete');

    Route::prefix(config('survey.path'))->middleware('auth')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('surveys.admin');
        Route::get('survey/{survey}/export', [AdminController::class, 'export'])->name('surveys.export');
    });
});