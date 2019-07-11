<?php


namespace Selander\Framework\Tests\DocBlock;

use PHPUnit\Framework\TestCase;
use Selander\Framework\DocBlock\Doc;
use Selander\Framework\DocBlock\Exceptions\LineFormatException;

class DocTest extends TestCase
{
    /**
     * @var string
     */
    protected $doc;

    protected function setUp()
    {
        parent::setUp();
        $this->doc = file_get_contents(__DIR__ . '/Stubs/docblock.txt');
    }

    /**
     * @test
     */
    public function get_nameSpaceExists_returnValue()
    {
        $this->assertEquals(
            'value',
            Doc::get($this->doc, 'Name\Space')
        );
    }

    /**
     * @test
     */
    public function get_nameSpaceNotExist_returnDefaultValue()
    {
        $this->assertEquals(
            'default',
            Doc::get('', 'Name\Space', 'default')
        );
    }

    /**
     * @test
     */
    public function lines_multiple_returnLines()
    {
        $this->assertEquals(
            ['@Name\Space("value")', '@Name\Other\Space("2")'],
            Doc::lines($this->doc)
        );
    }

    /**
     * @test
     */
    public function lines_empty_returnZeroLines()
    {
        $this->assertEquals(
            [],
            Doc::lines('')
        );
    }

    /**
     * @test
     */
    public function split_valid_returnKey()
    {
        list($key, $value) = Doc::split('@Name\Space("value")');

        $this->assertEquals(
            'Name\Space',
            $key
        );
    }

    /**
     * @test
     */
    public function split_valid_returnValue()
    {
        list($key, $value) = Doc::split('@Name\Space("value")');

        $this->assertEquals(
            'value',
            $value
        );
    }

    /**
     * @test
     */
    public function split_empty_throwException()
    {
        $this->expectException(LineFormatException::class);
        Doc::split('');
    }
}
