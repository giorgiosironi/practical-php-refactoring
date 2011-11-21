<?php
class PreserveWholeObject extends PHPUnit_Framework_TestCase
{
    public function testTheSlotEvaluatesItsLength()
    {
        $today = new DateTime('2011-11-23');
        $slot = new MonthSpecificSlot();
        $this->assertTrue($slot->containsAWeek($today, $today->format('m'), $today->format('d')));
    }
}

class MonthSpecificSlot
{
    public function containsAWeek($startDate, $month, $day)
    {
        $month = $startDate->format('m');
        $day = $startDate->format('d');
        $reference = new DateTime('2011-' . $month . '-01');
        $daysInMonth = $reference->format('t');
        return $day + 6 <= $daysInMonth;
    }
}
