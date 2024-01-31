<?php

namespace Core;

use Exception;

class ValidationException extends Exception
{
    public readonly array $errors; // readonly instead of protected
    public readonly array $old;

    public static function throw($errors, $old)
    {
        // construct the exception
        $instance = new static('The form failed to validate.');

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}