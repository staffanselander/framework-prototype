<?php


namespace Selander\Framework\DocBlock;


interface DocClassInterface extends DocItemInterface
{
    /**
     * @return DocItemInterface[]
     */
    public function properties(): array;

    /**
     * @return DocItemInterface[]
     */
    public function methods(): array;
}
