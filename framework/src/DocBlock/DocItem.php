<?php


namespace Selander\Framework\DocBlock;


class DocItem implements DocItemInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $doc;

    /**
     * DocItem constructor.
     * @param string $name
     * @param string $doc
     */
    public function __construct(string $name, string $doc)
    {
        $this->name = $name;
        $this->doc = $doc;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @param string $default
     * @return string
     */
    public function doc(string $name, string $default = ''): string
    {
        return Doc::get($this->doc, $name, $default);
    }
}
