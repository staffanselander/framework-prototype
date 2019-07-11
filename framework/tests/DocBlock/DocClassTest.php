<?php


namespace Selander\Framework\Tests\DocBlock;


use PHPUnit\Framework\TestCase;
use Selander\Framework\DocBlock\DocClass;
use Selander\Framework\Tests\DocBlock\Stubs\ClassWithDocBlock;
use Selander\Framework\Tests\DocBlock\Stubs\ClassWithoutDocBlock;

class DocClassTest extends TestCase
{
    /**
     * @var DocClass
     */
    protected $classWithDocBlock;

    /**
     * @var DocClass
     */
    protected $classWithoutDocBlock;

    protected function setUp()
    {
        parent::setUp();
        $this->classWithDocBlock = new DocClass(ClassWithDocBlock::class);
        $this->classWithoutDocBlock = new DocClass(ClassWithoutDocBlock::class);
    }


    /**
     * @test
     */
    public function name_classWithDocBlock_returnName()
    {
        $this->assertEquals(
            ClassWithDocBlock::class,
            $this->classWithDocBlock->name()
        );
    }

    /**
     * @test
     */
    public function doc_classWithDocBlock_returnValue()
    {
        $this->assertEquals(
            'value',
            $this->classWithDocBlock->doc('Some\Name')
        );
    }

    /**
     * @test
     */
    public function doc_classWithoutDocBlock_returnDefault()
    {
        $this->assertEquals(
            'default',
            $this->classWithoutDocBlock->doc('Some\Name', 'default')
        );
    }

    /**
     * @test
     */
    public function properties_classWithDocBlock_return2()
    {
        $this->assertCount(2, $this->classWithDocBlock->properties());
    }

    /**
     * @test
     */
    public function properties_classWithoutDocBlock_return2()
    {
        $this->assertCount(2, $this->classWithDocBlock->properties());
    }

    /**
     * @test
     */
    public function methods_classWithDocBlock_return2()
    {
        $this->assertCount(2, $this->classWithDocBlock->methods());
    }

    /**
     * @test
     */
    public function methods_classWithoutDocBlock_return2()
    {
        $this->assertCount(2, $this->classWithoutDocBlock->methods());
    }
}
