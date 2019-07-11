<?php


namespace Selander\Framework\Http;


interface RequestVarsInterface
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;
}
