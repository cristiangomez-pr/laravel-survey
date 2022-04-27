<?php

use Illuminate\Support\Facades\Route;
use MattDaneshvar\Survey\Http\Controllers\AdminController;
use MattDaneshvar\Survey\Http\Controllers\SurveysController;

Route::group(['middleware' => 'survey'], function () {
    Route::get('survey/{survey:slug}', [SurveysController::class, 'show'])->name('surveys.start');
    Route::post('survey/{survey}', [SurveysController::class, 'store'])->name('surveys.complete');

    Route::prefix(config('survey.path'))->middleware('auth')->group(function () {
        Route::get('surveys', [AdminController::class, 'index'])->name('surveys');
        Route::get('surveys/create', [AdminController::class, 'create'])->name('surveys.create');
        Route::get('surveys/{survey}/edit', [AdminController::class, 'edit'])->name('surveys.edit');

        Route::get('surveys/{survey}/export', [AdminController::class, 'export'])->name('surveys.export');
    });
});