<?php


namespace Selander\Framework\Database;


class ObjectFactory
{
    public static function createFromObjectContext(ObjectContext $context, array $properties)
    {
        $class = $context->class();
        $object = new $class();

        foreach ($context->properties() as $contextProperty) {
            if (array_key_exists($contextProperty->column(), $properties)) {
                $object->{$contextProperty->name()} = $properties[$contextProperty->column()];
            }
        }

        return $object;
    }
}
