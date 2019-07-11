<?php


namespace Selander\Framework\Template;


interface TemplateManagerInterface
{
    public function compile($pat, array $data = []): string;
}
