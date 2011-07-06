<?php
class ReplaceMethodWithMethodObjectTest extends PHPUnit_Framework_TestCase
{
    public function testDistanceBetweenPointsIsCalculated()
    {
        $london = new Point(51, 0);
        $rome = new Point(41, 12);
        $distance = $london->calculateDistance($rome);
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
        $distance = new EarthDistance($this->latitude,
                                      $this->longitude,
                                      $anotherPoint->latitude,
                                      $anotherPoint->longitude);
        return $distance->compute();
    }
}

class EarthDistance
{
    private $fromLatitude;
    private $fromLongitude;
    private $toLatitude;
    private $toLongitude;

    public function __construct($fromLatitude, $fromLongitude, $toLatitude, $toLongitude)
    {
        $this->fromLatitude = $fromLatitude;
        $this->fromLongitude = $fromLongitude;
        $this->toLatitude = $toLatitude;
        $this->toLongitude = $toLongitude;
    }

    public function compute()
    {
        $radian = 180/3.1415;
        $radiansLatitude = $this->fromLatitude / $radian;
        $anotherRadiansLatitude = $this->toLatitude / $radian;
        $radiansLongitude = $this->fromLongitude / $radian;
        $anotherRadiansLongitude = $this->toLongitude / $radian;
        $radius = 6371;
        $arc = acos(sin($radiansLatitude) * sin($anotherRadiansLatitude)
                  + cos($radiansLatitude) * cos($anotherRadiansLatitude)
                     * cos($radiansLongitude - $anotherRadiansLongitude));
        return round($arc * $radius);
    }
}
