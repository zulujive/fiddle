<?php

namespace Src\Methods;

class Config
{
    public static function config(): array
    {
        return [
            'DB_HOST' => env('DB_HOST', 'http://127.0.0.1:8090'),
            'DB_KEY' => env('DB_KEY', 'password'),

            'SET_PORT' => env('SET_PORT', 7890),

            'LOGIN_LIMIT' => env('LOGIN_LIMIT', 1),

            'DISPLAY_ERRORS' => env('DISPLAY_ERRORS', false),

            'MAINTENANCE_MODE' => env("MAINTENANCE_MODE", false),
            'MAINTENANCE_MESSAGE' => env('MAINTENANCE_MESSAGE', "The website is currently undergoing maintenance. We'll be back soons!")
        ];
    }

    public static function get(string $value) {
        return self::config()[$value] ?? null;
    }

}