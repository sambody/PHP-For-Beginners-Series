<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Authenticated::class
    ];

    /**
     * @throws \Exception
     */
    public static function resolve($key): void
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new \Exception("No matching middleware found for key '{$key}'.");
        }

        // todo ?
        (new $middleware)->handle();    // shorthand, since used only once
    }
}