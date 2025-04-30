<?php

return [
    'endpoints' => [
        'mistral' => 'https://api.mistral.ai/v1/chat/completions',
        'gemini'  => 'https://generativelanguage.googleapis.com/v1beta/models/{model}:generateContent',
        'claude'  => 'https://api.anthropic.com/v1/complete',
    ],

    'keys' => [
        'mistral' => env('MISTRAL_API_KEY'),
        'gemini'  => env('GEMINI_API_KEY'),
    ],

];
