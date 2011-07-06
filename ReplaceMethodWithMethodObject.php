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
    const EARTH_RADIUS = 6371;
    const RADIAN = 57.2958;
    private $fromLatitude;
    private $fromLongitude;
    private $toLatitude;
    private $toLongitude;

    /**
     * Let's just save only the radians value of the angles: in this object,
     * we only need this representation of them.
     */
    public function __construct($fromLatitude, $fromLongitude, $toLatitude, $toLongitude)
    {
        $this->fromLatitude = $fromLatitude / self::RADIAN;
        $this->fromLongitude = $fromLongitude / self::RADIAN;
        $this->toLatitude = $toLatitude / self::RADIAN;
        $this->toLongitude = $toLongitude / self::RADIAN;
    }

    public function compute()
    {
        return round($this->angularDistance() * self::EARTH_RADIUS);
    }

    /**
     * We still have the complex formula, but there is no method longer than 
     * 4 lines (3 lines if we do not count the constructor.)
     */
    private function angularDistance()
    {
        return acos(sin($this->fromLatitude) * sin($this->toLatitude)
                  + cos($this->fromLatitude) * cos($this->toLatitude)
                     * cos($this->fromLongitude - $this->toLongitude));
    }
}
