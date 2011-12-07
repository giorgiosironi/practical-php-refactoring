<?php
class EncapsulateDowncast extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $plate = new Plate('AB123XY');
        $newPlate = $plate->next();
        $this->assertEquals(new Plate('AB123XZ'), $newPlate);
    }
}

class Plate
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return Plate
     */
    public function next()
    {
        // we're dealing just with the basic case
        $lastLetter = substr($this->value, -1);
        $lastLetter++;
        $nextValue = substr_replace($this->value, $lastLetter, -1);
        return new self($nextValue);
    }
}
