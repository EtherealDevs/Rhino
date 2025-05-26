<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Editor
    |--------------------------------------------------------------------------
    |
    | Here you can specify the preferred editor that should be opened when
    | clicking file links. Possible values are 'vscode', 'phpstorm', 'sublime',
    | 'atom', 'nova' and 'emacs'.
    |
    */

    'editor' => env('IGNITION_EDITOR', 'vscode'),

    /*
    |--------------------------------------------------------------------------
    | Sharing
    |--------------------------------------------------------------------------
    |
    | Optionally, you can disable sharing of errors with Flare.
    |
    */

    'enable_share_button' => env('IGNITION_SHARE_BUTTON', true),

    /*
    |--------------------------------------------------------------------------
    | Error Reporting Level
    |--------------------------------------------------------------------------
    |
    | You can specify an error reporting level for when converting PHP errors
    | to exceptions. The default value is the level of `error_reporting()` it
    | had when the script started.
    |
    */

    'error_reporting' => null,

];

