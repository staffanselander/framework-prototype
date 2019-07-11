<?php


namespace Selander\Framework\DocBlock;

use ReflectionMethod;
use ReflectionProperty;

class DocItemFactory
{

    /**
     * @param ReflectionProperty $property
     * @return DocItemInterface
     */
    public static function createFromReflectionProperty(ReflectionProperty $property): DocItemInterface
    {
        return new DocItem(
            $property->getName(),
            $property->getDocComment()
        );
    }

    /**
     * @param ReflectionMethod $method
     * @return DocItemInterface
     */
    public static function createFromReflectionMethod(ReflectionMethod $method): DocItemInterface
    {
        return new DocItem(
            $method->getName(),
            $method->getDocComment()
        );
    }
}
