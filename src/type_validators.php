<?php

namespace Krak\Validation;

function type($type, $validator)
{
    return function($value) use ($type, $validator) {
        if ($validator($value)) {
            return null;
        }

        return new Violation(
            ViolationCodes::INVALID_TYPE,
            [$type, gettype($value)]
        );
    };
}

function type_bool()
{
    return type('bool', 'is_bool');
}

function type_string()
{
    return type('string', 'is_string');
}

function type_array()
{
    return type('array', 'is_array');
}

function type_numeric()
{
    return type('numeric', 'is_numeric');
}

function type_int()
{
    return type('int', 'is_int');
}

function type_double()
{
    return type('double', 'is_double');
}

function type_null()
{
    return type('null', 'is_null');
}

function is_instanceof($class)
{
    return function($value) use ($class) {
        if ($value instanceof $class) {
            return;
        }

        return new Violation(
            ViolationCodes::NOT_INSTANCE_OF,
            [$class, get_class($value)]
        );
    };
}

function is_traversable()
{
    return function($value) {
        if ($value instanceof \Traversable) {
            return;
        }

        return new Violation(
            ViolationCodes::NOT_TRAVERSABLE,
            []
        );
    };
}

function is_iterable()
{
    return function($value) {
        if ($value instanceof \Traversable || is_array($value)) {
            return;
        }

        return new Violation(
            ViolationCodes::NOT_ITERABLE,
            []
        );
    };
}
