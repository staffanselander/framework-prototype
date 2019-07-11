<?php


namespace Selander\Framework\Http;


interface PayloadInterface
{
    public function allPosts(): array;
    public function allGets(): array;

    public function getPost(string $key): string;
    public function getGet(string $key): string;

    public function has(string $key): string;
}
