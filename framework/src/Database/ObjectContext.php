<?php


namespace Selander\Framework\Database;


use Selander\Framework\DocBlock\DocClassInterface;
use Selander\Framework\DocBlock\DocItemInterface;

class ObjectContext
{
    /**
     * @var DocClassInterface
     */
    private $docClass;

    /**
     * ObjectContext constructor.
     * @param DocClassInterface $docClass
     */
    public function __construct(DocClassInterface $docClass)
    {
        $this->docClass = $docClass;
    }

    /**
     * @return string
     */
    public function class(): string
    {
        return $this->docClass->name();
    }

    /**
     * @return string
     */
    public function table(): string
    {
        return $this->docClass->doc('Store\Table');
    }

    /**
     * @return string
     */
    public function primaryKey(): string
    {
        return $this->docClass->doc('Store\PrimaryKey');
    }

    /**
     * @return ObjectContextProperty[]
     */
    public function properties(): array
    {
        return array_map(function (DocItemInterface $docItem) {
            return new ObjectContextProperty($docItem);
        }, $this->docClass->properties());
    }
}
