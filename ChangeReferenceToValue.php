<?php
class Color
{
    private $red;
    private $green;
    private $blue;
    private static $colors = array();

    private function __construct($r, $g, $b)
    {
        $this->red = $r;
        $this->green = $g;
        $this->blue = $b;
    }

    /**
     * A static lookup method is common for the Flyweight pattern 
     * implementation, and keeps only one instance of each color around.
     * An equivalent starting point would be a ColorRepository or ColorFactory
     * class.
     */
    public static function getColor($r, $g, $b)
    {
        $code = $r . $g . $b;
        if (!isset(self::$colors[$code])) {
            self::$colors[$code] = new self($r, $g, $b);
        }
        return self::$colors[$code];
    }

    /* ... other methods ... */
}

class ReferenceObjectTest extends PHPUnit_Framework_TestCase
{
    public function testASingleInstanceCanBeCreated()
    {
        $blue = Color::getColor(0, 0, 255);
        $anotherBlue = Color::getColor(0, 0, 255);
        $this->assertSame($blue, $anotherBlue);
    }
}
