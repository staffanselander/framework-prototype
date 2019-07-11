<?php


namespace Selander\Framework\Tests\HttpCore;


use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Selander\Framework\Http\Url;
use Selander\Framework\Http\UrlInterface;

class UrlTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function new_invalidScheme_throwException()
    {
        $this->expectException(InvalidArgumentException::class);
        new Url('httpd', 'john', 'example.com', 8000, '/path', 'key=value', 'hash');
    }

    /**
     * @test
     */
    public function new_pathWithoutSlash_throwException()
    {
        $this->expectException(InvalidArgumentException::class);
        new Url(UrlInterface::SCHEME_HTTP, 'john', 'example.com', 8000, 'path', 'key=value', 'hash');
    }

    /**
     * @test
     */
    public function toString_fullInfo_returnString()
    {
        $url = new Url(UrlInterface::SCHEME_HTTP, 'john', 'example.com', 8000, '/path', 'key=value', 'hash');

        $this->assertEquals(
            'http://john@example.com:8000/path?key=value#hash',
            $url->toString()
        );
    }

    /**
     * @test
     */
    public function toString_port80_returnStringWithoutPort()
    {
        $url = new Url(UrlInterface::SCHEME_HTTP, 'john', 'example.com', 80, '/path', 'key=value', 'hash');

        $this->assertEquals(
            'http://john@example.com/path?key=value#hash',
            $url->toString()
        );
    }

    /**
     * @test
     */
    public function toString_port443_returnStringWithoutPort()
    {
        $url = new Url(UrlInterface::SCHEME_HTTPS, 'john', 'example.com', 443, '/path', 'key=value', 'hash');

        $this->assertEquals(
            'https://john@example.com/path?key=value#hash',
            $url->toString()
        );
    }
}
