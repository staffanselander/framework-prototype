<?php


namespace Selander\Framework\DocBlock;


interface DocItemInterface
{
    public function name(): string;

    /**
     * @param string $name
     * @param string $default
     * @return string
     */
    public function doc(string $name, string $default = ''): string;
}
