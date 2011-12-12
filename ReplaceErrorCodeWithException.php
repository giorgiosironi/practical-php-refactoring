<?php
class ReplaceErrorCodeWithException extends PHPUnit_Framework_TestCase
{
    public function testItemsCanBeAddedAtWill()
    {
        $bag = new Bag(10);
        $result = $bag->addItem('Domain-Driven Design', 10);
        $this->assertEquals(0, $result);
    }

    public function testTheWeightLimitCannotBeInfringed()
    {
        $bag = new Bag(10);
        $result = $bag->addItem('Land of Lisp', 11);
        $this->assertEquals(Bag::TOO_MUCH_WEIGHT, $result);
    }
}

class Bag
{
    private $weightLimit;
    private $weight;

    const TOO_MUCH_WEIGHT = 1;

    public function __construct($weightLimit)
    {
        $this->weightLimit = $weightLimit;
        $this->weight = 0;
    }

    /**
     * @return int  0 if no errors
     */
    public function addItem($name, $itemWeight)
    {
        if ($this->weightLimit < $this->weight + $itemWeight) {
            return self::TOO_MUCH_WEIGHT;
        }
        $this->weight += $itemWeight;
        return 0;
    }
}
