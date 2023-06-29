<?php

namespace Src\Methods;

use Dotenv\Dotenv;

class Environment
{
    public static function load(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();

        # Ensure all required environment variables are present
        $dotenv->ifPresent('DB_HOST');
        $dotenv->ifPresent('DB_KEY');

        $dotenv->ifPresent('SET_PORT')->isInteger();

        $dotenv->ifPresent('LOGIN_LIMIT')->isInteger();

        $dotenv->ifPresent('DISPLAY_ERRORS')->isBoolean();

        $dotenv->ifPresent('MAINTENANCE_MODE')->isBoolean();
        $dotenv->ifPresent('MAINTENANCE_MESSAGE');
    }

    public static function get(string $value): ?string
    {
        return $_ENV[$value] ?? null;
    }

}