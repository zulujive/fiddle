<?php

use Src\Methods\Config;
use Src\Methods\Environment;

if (!function_exists('env')) {
    function env(string $key, $default=null)
    {
        $value = Environment::get($key);

        if (!$value) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return null;
        }

        if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('config')) {
    function config(string $value) {
        return Config::get($value);
    }
}