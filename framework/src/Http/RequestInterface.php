<?php


namespace Selander\Framework\Http;


interface RequestInterface
{
    const METHOD_HEAD = 'HEAD';
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';
    const METHOD_OPTIONS = 'OPTIONS';

    public function method(): string;
    public function url(): UrlInterface;
    public function headers(): HeadersInterface;

    public function get(): RequestVarsInterface;
    public function post(): RequestVarsInterface;
}
