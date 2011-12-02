<?php
class ReplaceConstructorWithFactoryMethod extends PHPUnit_Framework_TestCase
{
    public function testAnAreaIsCreatedGivenTheTwoOppositeCorners()
    {
        $area = Area::fromXYtoXY(1, 11, 100, 210);
        $this->assertEquals(20000, $area->measure());
    }

    public function testAnAreaIsCreatedAroundAPoint()
    {
        $area = Area::fromCenterAndDimension(400, 500, 100);
        $this->assertEquals(10000, $area->measure());
    }
}

class Area
{
    private $first_corner_x;
    private $first_corner_y;
    private $second_corner_x;
    private $second_corner_y;

    public function __construct($first_x, $first_y, $second_x, $second_y)
    {
        $this->first_corner_x = $first_x;
        $this->first_corner_y = $first_y;
        $this->second_corner_x = $second_x;
        $this->second_corner_y = $second_y;
    }

    public static function fromXYtoXY($first_x, $first_y, $second_x, $second_y)
    {
        return new self($first_x, $first_y, $second_x, $second_y);
    }

    public static function fromCenterAndDimension($center_x, $center_y, $dimension)
    {
        $first_x = $center_x - $dimension / 2 + 1;
        $first_y = $center_y - $dimension / 2 + 1;
        $second_x = $center_x + $dimension / 2;
        $second_y = $center_y + $dimension / 2;
        return new self($first_x, $first_y, $second_x, $second_y);
    }

    public function measure()
    {
        $width = $this->second_corner_x - $this->first_corner_x + 1;
        $height = $this->second_corner_y - $this->first_corner_y + 1;
        return $width * $height;
    }
}
