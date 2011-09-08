<?php
class EncapsulateField extends PHPUnit_Framework_TestCase
{
    public function testTheFieldCanBeManipulated()
    {
        $reservation = new Reservation();
        $reservation->date = '2010-01-01';
        $this->assertTrue($reservation->isOutdated());
    }
}

class Reservation
{
    public $date;

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function isOutdated()
    {
        // global state! Avoid this in real code
        return $this->date < date('Y-m-d');
    }
}
