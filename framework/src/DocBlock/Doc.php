<?php


namespace Selander\Framework\DocBlock;


use Selander\Framework\DocBlock\Exceptions\LineFormatException;

abstract class Doc
{
    /**
     * @param string $doc
     * @param string $name
     * @param string $default
     * @return string
     */
    public static function get(string $doc, string $name, string $default = ''): string
    {
        foreach (self::lines($doc) as $line) {
            list($key, $value) = self::trySplit($line);

            if ($key === $name) {
                return $value;
            }
        }

        return $default;
    }

    /**
     * @param string $doc
     * @return array
     */
    public static function lines(string $doc): array
    {
        preg_match_all('/@.*\(".*"\)/', $doc, $matches);
        return $matches[0];
    }

    /**
     * @param string $line
     * @return array
     */
    public static function trySplit(string $line): array
    {
        try {
            return self::split($line);
        } catch (LineFormatException $_) {
            return [null, null];
        }
    }

    /**
     * @param string $line
     * @return array
     * @throws LineFormatException
     */
    public static function split(string $line): array
    {
        preg_match_all('/@(.*)\("(.*)"\)/', $line, $matches);

        if (count($matches[1]) !== 1 || count($matches[2]) !== 1) {
            throw new LineFormatException(sprintf('Line "%s" has a invalid format', $line));
        }

        return [$matches[1][0], $matches[2][0]];
    }
}
