<?php

use Core\Response;

// Sometimes functions can be turned into separate classes

function dd($value)
{
    // dump and die
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN): bool
{
    // check for authorization condition
    // send default status value
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function view($path, $attributes = []): void
{
    // For each key/value pair of the associative array, it will create a separate variable
    // eg. 'heading' => 'About Us'
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($path)
{
    header("location: $path");
    exit();
}

function old($key, $default = '')
{
    // shorthand, get old value, return empty string (or optional param) if not existing
    // use in form to add old submitted value
    return Core\Session::get('old')[$key] ?? $default;
}