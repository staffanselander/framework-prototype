<?php


namespace Selander\Framework\Tests\HttpCore;


trait ServerVarsTrait
{
    public function getServerVars(): array
    {
        return [
            'DOCUMENT_ROOT' => '/app/mvc-framework/bin',
            'REMOTE_ADDR' => '127.0.0.1',
            'REMOTE_PORT' => '62649',
            'SERVER_PROTOCOL' => 'HTTP/1.1',
            'SERVER_NAME' => 'example.com',
            'SERVER_PORT' => '8000',
            'REQUEST_URI' => '/path?key=value',
            'REQUEST_METHOD' => 'GET',
            'SCRIPT_NAME' => '/path',
            'SCRIPT_FILENAME' => 'server.php',
            'PHP_SELF' => '/path',
            'QUERY_STRING' => 'key=value',
            'HTTP_HOST' => 'example.com:8000',
            'HTTP_USER_AGENT' => 'supreme-os',
            'HTTP_ACCEPT' => '*/*',
            'REQUEST_TIME_FLOAT' => 1562231602.240447,
            'REQUEST_TIME' => 1562231602,
            'argv' => [
                'key = value'
            ],
            'argc' => 1
        ];
    }
}
