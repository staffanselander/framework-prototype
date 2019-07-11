<?php


namespace Selander\Framework\Tests\HttpCore;


use PHPUnit\Framework\TestCase;
use Selander\Framework\Http\UrlFactory;
use Selander\Framework\Support\GlobalVars;

class UrlFactoryTest extends TestCase
{
    /**
     * @var UrlFactory
     */
    protected $urlFactory;

    /**
     * @var array
     */
    protected $fake_SERVER = [
        'HTTPS' => 'on',
        'SERVER_NAME' => 'example.com',
        'SERVER_PORT' => '443',
        'REQUEST_URI' => '/path',
        'QUERY_STRING' => 'key=value',
    ];

    protected function setUp()
    {
        parent::setUp();
        $this->urlFactory = new UrlFactory();
    }

    /**
     * @test
     */
    public function createFromServer_standard_url()
    {
        $url = $this->urlFactory->createFromGlobalVars(
            new GlobalVars($this->fake_SERVER, [], [])
        );

        $this->assertEquals(
            'https://example.com/path?key=value',
            $url->toString()
        );
    }
}
