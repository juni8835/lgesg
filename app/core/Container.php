<?php

namespace app\core; 

class Container
{
    protected $bindings = [];

    public function bind(string $name, callable $resolver)
    {
        $this->bindings[$name] = $resolver;
    }

    public function make(string $name)
    {
        if (!isset($this->bindings[$name])) {
            throw new \Exception("Service [$name] not bound.");
        }

        return call_user_func($this->bindings[$name]);
    }
}
