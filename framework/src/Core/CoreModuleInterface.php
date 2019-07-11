<?php


namespace Selander\Framework\Core;


interface CoreModuleInterface
{
    public function warmUp();
    public function execute();
}
