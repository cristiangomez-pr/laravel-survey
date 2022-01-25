<?php

namespace MattDaneshvar\Survey;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use MattDaneshvar\Survey\Http\View\Composers\SurveyComposer;

class SurveyServiceProvider extends ServiceProvider
{
    /**
     * Boot the package.
     *
     * @param  ViewFactory  $viewFactory
     */
    public function boot(ViewFactory $viewFactory)
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'survey');

        $this->mergeConfigFrom(__DIR__.'/../config/survey.php', 'survey');

        $viewFactory->composer('survey::standard', SurveyComposer::class);

        $this->configureComponents();
        $this->configurePublishing();
    }

       /**
     * Configure the Jetstream Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('button');
            $this->registerComponent('section-title');
            $this->registerComponent('section-message');
            $this->registerComponent('question-base');
            $this->registerComponent('input');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('survey::components.'.$component, 'survey-'.$component);
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/survey.php' => config_path('survey.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views/' => base_path('resources/views/vendor/survey'),
        ], 'views');

        $this->publishMigrations([
            'create_surveys_table',
            'create_survey_questions_table',
            'create_survey_entries_table',
            'create_survey_answers_table',
            'create_survey_sections_table',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\MattDaneshvar\Survey\Contracts\Answer::class, \MattDaneshvar\Survey\Models\Answer::class);
        $this->app->bind(\MattDaneshvar\Survey\Contracts\Entry::class, \MattDaneshvar\Survey\Models\Entry::class);
        $this->app->bind(\MattDaneshvar\Survey\Contracts\Question::class, \MattDaneshvar\Survey\Models\Question::class);
        $this->app->bind(\MattDaneshvar\Survey\Contracts\Section::class, \MattDaneshvar\Survey\Models\Section::class);
        $this->app->bind(\MattDaneshvar\Survey\Contracts\Survey::class, \MattDaneshvar\Survey\Models\Survey::class);
    }

    /**
     * Publish package migrations.
     *
     * @param $migrations
     */
    protected function publishMigrations($migrations)
    {
        foreach ($migrations as $migration) {
            $migrationClass = Str::studly($migration);

            if (class_exists($migrationClass)) {
                return;
            }

            $this->publishes([
                __DIR__."/../database/migrations/$migration.php.stub" => database_path('migrations/'.date('Y_m_d_His',
                        time())."_$migration.php"),
            ], 'migrations');
        }
    }
}
