<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Survey Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Survey will be accessible from. If the
    | setting is null, Survey will reside under the same domain as the
    | application. Otherwise, this value will be used as the subdomain.
    |
    */

    'domain' => env('SURVEY_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | Survey Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Survey will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'path' => env('SURVEY_PATH', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Survey Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Survey route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
    ],

     /*
    |--------------------------------------------------------------------------
    | Survey Database related configurations.
    |--------------------------------------------------------------------------
    |
    | Name of the tables created by the migrations
    | and used by the models of this package.
    |
    */

    'database' => [
        'tables' => [
            'surveys' => 'surveys',
            'sections' => 'survey_sections',
            'questions' => 'survey_questions',
            'entries' => 'survey_entries',
            'answers' => 'survey_answers',
        ],
    ],
];
