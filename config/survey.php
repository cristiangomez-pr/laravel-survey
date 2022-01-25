<?php

return [

    /*
     * Database related configurations.
     */
    'database' => [
        /*
         * Name of the tables created by the migrations
         * and used by the models of this package.
         */
        'tables' => [
            'surveys' => 'surveys',
            'sections' => 'survey_sections',
            'questions' => 'survey_questions',
            'entries' => 'survey_entries',
            'answers' => 'survey_answers',
        ],
    ],
];
