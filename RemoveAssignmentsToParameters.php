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
     * These docblock will be outdated after reading one line into the method.
     * @param int $firstMeridian    from -180 to 180
     * @param int $secondMeridian   from -180 to 180
     * I wrote this, but in a week I will hardly follow the logic inside.
     * While in the case of Split Temporary Variable $date was still a DateTime
     * object, here the meaning of $secondMeridian becomes completely different.
     */
    public function getDistanceBetweenMeridians($firstMeridian, $secondMeridian)
    {
        $secondMeridian -= $firstMeridian;
        $secondMeridian *= 60;
        $secondMeridian *= 1.852;
        return round($secondMeridian);
    }
}
