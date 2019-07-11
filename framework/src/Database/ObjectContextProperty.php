<?php


namespace Selander\Framework\Database;

use Selander\Framework\DocBlock\DocItemInterface;

class ObjectContextProperty
{
    /**
     * @var DocItemInterface
     */
    private $docItem;

    /**
     * ObjectContextProperty constructor.
     * @param DocItemInterface $docItem
     */
    public function __construct(DocItemInterface $docItem)
    {
        $this->docItem = $docItem;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->docItem->name();
    }

    /**
     * @return string
     */
    public function column(): string
    {
        return $this->docItem->doc('Store\Column');
    }

    /**
     * @return bool
     */
    public function autoIncrements(): bool
    {
        return $this->docItem->doc('Store\AutoIncrements', 'false') === 'true';
    }
}
