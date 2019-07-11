<?php


namespace Selander\Framework\Router;


abstract class Wildcard
{
    const PREFIX = ':';

    /**
     * @param string $part
     * @return bool
     */
    public static function check(string $part): bool
    {
        return substr($part, 0, 1) === self::PREFIX;
    }

    /**
     * @param string $part
     * @return string
     */
    public static function name(string $part): string
    {
        return substr($part, 1);
    }

    /**
     * @param Path $definition
     * @param Path $path
     * @return array
     */
    public static function extract(Path $definition, Path $path): array
    {
        $wildcards = [];

        for ($i = 0; $i < $definition->size(); $i++) {
            $part = $definition->part($i);

            if (self::check($part)) {
                $wildcards[self::name($part)] = $path->part($i);
            }
        }

        return $wildcards;
    }
}
