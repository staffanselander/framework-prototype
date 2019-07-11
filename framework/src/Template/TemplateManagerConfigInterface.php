<?php


namespace Selander\Framework\Template;


interface TemplateManagerConfigInterface
{
    const ROOT = 'root';
    public function get(string $key): string;
    public function set(string $key, string $value): TemplateManagerConfigInterface;
}
