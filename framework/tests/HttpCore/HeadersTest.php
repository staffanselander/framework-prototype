<?php


namespace Selander\Framework\Tests\HttpCore;


use PHPUnit\Framework\TestCase;
use Selander\Framework\Http\Headers;
use Selander\Framework\Http\HeadersInterface;

class HeadersTest extends TestCase
{
    public function new_withHeaders_instance()
    {
        new Headers([
            'Content-Type' => 'application/json'
        ]);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function set_valueKey_returnSelf()
    {
        $this->assertInstanceOf(
            HeadersInterface::class,
            new Headers(['Content-Type' => 'application/json'])
        );
    }

    /**
     * @test
     */
    public function all_multipleValues_returnArray()
    {
        $headers = new Headers([
            'Content-Type' => 'application/json',
            'Language' => 'sv',
        ]);

        $this->assertArraySubset([
            'Content-Type' => 'application/json',
            'Language' => 'sv',
        ], $headers->all());
    }

    /**
     * @test
     */
    public function get_header_undefined_returnEmptyString()
    {
        $headers = new Headers([]);

        $this->expectException(\TypeError::class);
        $headers->get('Content-Type');
    }

    /**
     * @test
     */
    public function get_header_defined_returnValue()
    {
        $headers = new Headers([
            'Content-Type' => 'application/json'
        ]);

        $this->assertEquals(
            'application/json',
            $headers->get('Content-Type')
        );
    }

}
