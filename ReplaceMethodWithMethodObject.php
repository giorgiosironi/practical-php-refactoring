<?php
class ReplaceMethodWithMethodObjectTest extends PHPUnit_Framework_TestCase
{
    public function testDistanceBetweenPointsIsCalculated()
    {
        $london = new Point(51, 0);
        $rome = new Point(41, 12);
        $distance = $london->calculateDistance($rome);
        var_dump($distance);
        $this->assertEquals(1444, $distance);
    }
}

class Point
{
    private $latitude;
    private $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
    
    public function calculateDistance(Point $anotherPoint)
    {
        $radian = 180/3.1415;
        $radiansLatitude = $this->latitude / $radian;
        $anotherRadiansLatitude = $anotherPoint->latitude / $radian;
        $radiansLongitude = $this->longitude / $radian;
        $anotherRadiansLongitude = $anotherPoint->longitude / $radian;
        $radius = 6371;
        $arc = acos(sin($radiansLatitude) * sin($anotherRadiansLatitude)
                  + cos($radiansLatitude) * cos($anotherRadiansLatitude)
                     * cos($radiansLongitude - $anotherRadiansLongitude));
        return round($arc * $radius);
    }
}
