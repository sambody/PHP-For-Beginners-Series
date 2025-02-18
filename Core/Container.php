<?php

namespace Core;

use Exception;

class Container
{
    // todo ?
    // used in bootstrap
    protected array $bindings = [];

    public function bind($key, $resolver): void
    {
        // add to array - key + function
        $this->bindings[$key] = $resolver;
    }

    /**
     * @throws Exception
     */
    public function resolve($key)
    {
        // get the corresponding function if it exists
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        // call the callback function
        return call_user_func($resolver);
    }
}