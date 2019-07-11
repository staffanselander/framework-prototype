<?php


namespace Selander\Framework\Router;


class Path implements PathInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var number
     */
    private $size;

    /**
     * @var array
     */
    private $parts;

    /**
     * Url constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->parts = array_filter(explode('/', $path));
        $this->size = count($this->parts);
    }

    /**
     * @return array
     */
    public function parts(): array
    {
        return $this->parts;
    }

    /**
     * @param int $index
     * @return string
     */
    public function part(int $index): string
    {
        return $this->parts[$index] ?? '';
    }

    /**
     * @return int
     */
    public function size(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->path;
    }
}
