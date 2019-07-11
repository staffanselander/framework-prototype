<?php


namespace Selander\Framework\Tests\HttpCore;


use PHPUnit\Framework\TestCase;
use Selander\Framework\Http\Util;

class UtilTest extends TestCase
{
    /**
     * @test
     */
    public function isHttps_on_returnTrue()
    {
        $this->assertTrue(
            Util::isHttps(['HTTPS' => 'on'])
        );
    }

    /**
     * @test
     */
    public function isHttps_numberOne_returnTrue()
    {
        $this->assertTrue(
            Util::isHttps(['HTTPS' => '1'])
        );
    }

    /**
     * @test
     */
    public function isHttps_port443_returnTrue()
    {
        $this->assertTrue(
            Util::isHttps(['SERVER_PORT' => '443'])
        );
    }

    /**
     * @test
     */
    public function isHttps_port80_returnFalse()
    {
        $this->assertFalse(
            Util::isHttps(['SERVER_PORT' => '80'])
        );
    }

    /**
     * @test
     */
    public function isHttps_off_returnFalse()
    {
        $this->assertFalse(
            Util::isHttps(['HTTPS' => 'off'])
        );
    }
}
