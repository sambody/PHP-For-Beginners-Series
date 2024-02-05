<?php

namespace Core;

class App
{
    protected static $container;

    // set container
    public static function setContainer($container)
    {
        static::$container = $container;        // or self::$container
    }

    // get container
    public static function container()
    {
        return static::$container;
    }

    // todo ?
    public static function bind($key, $resolver)
    {
        static::container()->bind($key, $resolver);
    }

    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
}
