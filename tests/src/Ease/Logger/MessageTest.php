<?php

namespace Test\Ease\Logger;

use Ease\Logger\Message;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-12-29 at 21:58:32.
 */
class MessageTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Message
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new Message('test');
    }

    public function testConstructor()
    {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $mock->__construct('test');
        $mock->__construct('test', 'test', 'test', 'now');
        $this->assertEquals('test', $mock->body);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        
    }

    public function testGetTypeUnicodeSymbol()
    {
        $this->assertEquals('✉', Message::getTypeUnicodeSymbol('mail'));
        $this->assertEquals('⚠', Message::getTypeUnicodeSymbol('warning'));
        $this->assertEquals('☠', Message::getTypeUnicodeSymbol('error'));
        $this->assertEquals('❁', Message::getTypeUnicodeSymbol('success'));
        $this->assertEquals('⚙', Message::getTypeUnicodeSymbol('debug'));
        $this->assertEquals('ⓘ', Message::getTypeUnicodeSymbol('info'));
        $this->assertEquals('ⓘ', Message::getTypeUnicodeSymbol('anythingelse'));
    }
}
