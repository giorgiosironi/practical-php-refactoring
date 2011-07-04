<?php
class RemoveAssignmentsToParametersTest extends PHPUnit_Framework_TestCase
{
    public function testCalculatesDistanceBetweenMeridiansOnTheEasternEmisphere()
    {
        $world = new World();
        $distance = $world->getDistanceBetweenMeridians(15, 80);
        $this->assertEquals(7223, $distance);
    }
}

class World
{
    /**
     * The local variable names serve as documentation now.
     * @param int $firstMeridian    from -180 to 180
     * @param int $secondMeridian   from -180 to 180
     */
    public function getDistanceBetweenMeridians($firstMeridian, $secondMeridian)
    {
        $degreesOfDifference = $secondMeridian - $firstMeridian;
        $nauticalMiles = $degreesOfDifference * 60;
        $distance = $nauticalMiles * 1.852;
        return round($distance);
    }
}
