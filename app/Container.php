<?php

namespace App;

use Exception;
use ReflectionClass;
use ReflectionNamedType;

class Container
{
    private array $entries = [];

    public function get(string $class)
    {
        if ($this->has($class)) {
            $entry = $this->entries[$class];
            return $entry($this);
        }
        return $this->resolve($class);
    }

    public function has(string $class): bool
    {
        return isset($this->entries[$class]);
    }

    public function set(string $class, callable $concrete)
    {
        $this->entries[$class] = $concrete;
    }

    public function resolve(string $class)
    {

        // 1. Inspect the class
        $reflectionClass = new \ReflectionClass($class);
        if (!$reflectionClass->isInstantiable()) {
            throw new Exception('Class ' . $class . ' is not instantiable');
        }

        // 2. Inspect the constructor
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return new $class();
        }

        // 3. Inspect the constructor parameters
        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return new $class();
        }

        // 4. If the constructor parameter is a class then try to resolve that class using the container
        $dependencies = array_map(function (\ReflectionParameter $param) use ($class) {
            $name = $param->getName();
            $type = $param->getType();
            if (!$type) {
                throw new Exception('Failed to resolve class ' . $class .
                'because parameter ' . $name . ' is missing a type hint');
            }
            if ($type instanceof \ReflectionUnionType) {
                throw new Exception('Failed to resolve class ' . $class .
                'because of union type of parameter ' . $name);
            }
            if ($type instanceof \ReflectionNamedType && ! $type->isBuiltin()) {
                return $this->get($type->getName());
            }
            throw new Exception('Failed to resolve class ' . $class .
                'because of invalid parameter ' . $name);
        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}
