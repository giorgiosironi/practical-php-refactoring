<?php
class ReplaceParameterWithExplicitMethods extends PHPUnit_Framework_TestCase
{
    public function testThreadCanBeClosed()
    {
        $thread = new Thread('Ubuntu on EEE Pc');
        $thread->setOpen(false);
        $this->assertFalse($thread->getOpen());
        $this->assertEquals('[closed] Ubuntu on EEE Pc', $thread->__toString());
    }

    public function testThreadCanBeOpened()
    {
        $thread = new Thread('Ubuntu on EEE Pc');
        $thread->setOpen(true);
        $this->assertTrue($thread->getOpen());
        $this->assertEquals('Ubuntu on EEE Pc', $thread->__toString());
    }
}

class Thread
{
    private $title;
    private $open;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function setOpen($state)
    {
        $this->open = $state;
        if (!$this->open) {
            $this->label = '[closed] ' . $this->title;
        } else {
            $this->label = $this->title;
        }
    }

    public function open()
    {
        $this->open = true;
        $this->label = $this->title;
    }

    public function close()
    {
        $this->open = false;
        $this->label = '[closed] ' . $this->title;
    }

    public function getOpen()
    {
        return $this->open;
    }

    public function __toString()
    {
        return $this->label;
    }
}
