<?php


namespace Selander\Framework\Tests\HttpCore;


use PHPUnit\Framework\TestCase;
use Selander\Framework\Http\HeadersFactory;
use Selander\Framework\Support\GlobalVars;

class HeadersFactoryTest extends TestCase
{
    use ServerVarsTrait;

    /**
     * @var HeadersFactory
     */
    protected $headersFactory;

    protected function setUp()
    {
        parent::setUp();
        $this->headersFactory = new HeadersFactory();
    }

    /**
     * @test
     */
    public function createFromServer_fakedVars_world()
    {
        $headers = $this->headersFactory->createFromGlobalVars(new GlobalVars($this->getServerVars(), [], []));

        $this->assertEquals([
            'Host' => 'example.com:8000',
            'User-Agent' => 'supreme-os',
            'Accept' => '*/*'
        ], $headers->all());
    }
}
