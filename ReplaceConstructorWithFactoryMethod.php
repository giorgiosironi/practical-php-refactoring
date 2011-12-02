<?php
class ReplaceConstructorWithFactoryMethod extends PHPUnit_Framework_TestCase
{
    public function testAnAreaIsCreatedGivenTheTwoOppositeCorners()
    {
        $area = new Area(1, 11, 100, 210);
        $this->assertEquals(20000, $area->measure());
    }

    public function testAnAreaIsCreatedAroundAPoint()
    {
        $area = new Area(400, 500, 100);
        $this->assertEquals(10000, $area->measure());
    }
}

class Area
{
    private $first_corner_x;
    private $first_corner_y;
    private $second_corner_x;
    private $second_corner_y;

    public function __construct($first_x, $first_y, $second_x, $second_y = null)
    {
        if ($second_y === null) {
            $size = $second_x;
            $this->first_corner_x = $first_x - $size / 2 + 1;
            $this->first_corner_y = $first_y - $size / 2 + 1;
            $this->second_corner_x = $first_x + $size / 2;
            $this->second_corner_y = $first_y + $size / 2;
        } else {
            $this->first_corner_x = $first_x;
            $this->first_corner_y = $first_y;
            $this->second_corner_x = $second_x;
            $this->second_corner_y = $second_y;
        }
    }

    public function measure()
    {
        $width = $this->second_corner_x - $this->first_corner_x + 1;
        $height = $this->second_corner_y - $this->first_corner_y + 1;
        return $width * $height;
    }
}
