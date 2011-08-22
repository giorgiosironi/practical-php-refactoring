<?php
class Color
{
    private $red;
    private $green;
    private $blue;

    private function __construct($r, $g, $b)
    {
        $this->red = $r;
        $this->green = $g;
        $this->blue = $b;
    }

    public static function getColor($r, $g, $b)
    {
        return new self($r, $g, $b);
    }

    /* ... other methods ... */
}

class ReferenceObjectTest extends PHPUnit_Framework_TestCase
{
    public function testEqualInstancesCanBeCreated()
    {
        $blue = Color::getColor(0, 0, 255);
        $anotherBlue = Color::getColor(0, 0, 255);
        $this->assertEquals($blue, $anotherBlue);
    }
}
