<?php
class SplitTemporaryVariableTest extends PHPUnit_Framework_TestCase
{
    public function testDatesAreShiftedAtTheEndOfSomeFutureMonth()
    {
        $adjustment = new Adjustment(3);
        $futureDate = $adjustment->apply(new DateTime('2011-06-20'));
        $this->assertEquals(new DateTime('2011-09-30'), $futureDate);
    }
}

class Adjustment
{
    public function __construct($minimumMonths)
    {
        $this->minimumMonths = $minimumMonths;
    }

    public function apply(DateTime $date)
    {
        $someMonthsInTheFuture = $date->add(new DateInterval('P3M'));
        $lastDayOfTheMonth = $someMonthsInTheFuture->setDate($someMonthsInTheFuture->format('Y'), $someMonthsInTheFuture->format('m'), $someMonthsInTheFuture->format('t'));
        return $lastDayOfTheMonth;
    }
}
