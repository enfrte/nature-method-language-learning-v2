<?php

// fn add line: 
// get all locales 
// Foreach local, pull update chapter and page
// If locale == en, add the new text, else add an empty line using array_splice
// Update the database, first deleting everything on the page in the current, then inserting everything you have locally


// Chapter 
    // Page
        // Main
        // Aside

$arr = [

    1 => [ // Chapter
        1 => [ // Page
            'main' => [ // Sentence
                0 => 'A sentence...'
            ],
            'aside' => [
                0 => 'An aside...'
            ],
        ],
        2 => [ // Page
            'main' => [
                0 => 'A sentence...'
            ],
            'aside' => [
                0 => 'An aside...'
            ],
        ],
        // ...
    ],
    2 => [ // Chapter
        20 => [ // Page
            'main' => [
                0 => 'A sentence...'
            ],
            'aside' => [
                0 => 'An aside...'
            ],
        ],
    ],

];

