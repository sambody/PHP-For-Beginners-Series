<?php

namespace Core;

class Session
{
    // Static functions
    public static function has($key): bool
    {
        // check if it has key
        return (bool) static::get($key);    // static::get or self::get
    }

    public static function put($key, $value): void
    {
        // add / put
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        // get; check "_flash" sub key first, if not normal key, if not default
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value): void
    {
        // add flash key (used once and deleted)
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash(): void
    {
        // remove flash key
        unset($_SESSION['_flash']);
    }

    public static function flush(): void
    {
        // empty the session global variable
        $_SESSION = [];
    }

    public static function destroy(): void
    {
        // empty session variable, destroy session, remove cookie
        static::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}