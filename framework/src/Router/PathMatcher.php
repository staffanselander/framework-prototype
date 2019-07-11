<?php


namespace Selander\Framework\Router;


class PathMatcher
{
    /**
     * @var Path
     */
    private $definition;

    /**
     * @var Path
     */
    private $path;

    /**
     * UrlMatcher constructor.
     * @param Path $definition
     * @param Path $path
     */
    public function __construct(Path $definition, Path $path)
    {
        $this->definition = $definition;
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        if ($this->definition->toString() === $this->path->toString()) {
            return true;
        }

        if ($this->definition->size() !== $this->path->size()) {
            return false;
        }

        for ($i = 0; $i < $this->definition->size(); $i++) {
            if (Wildcard::check($this->definition->part($i))) {
                continue;
            }

            if ($this->definition->part($i) !== $this->path->part($i)) {
                return false;
            }
        }

        return true;
    }

}
