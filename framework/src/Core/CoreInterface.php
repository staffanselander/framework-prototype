<?php


namespace Selander\Framework\Core;


interface CoreInterface
{
    public function modules(array $modules): CoreInterface;
    public function run();
}
