<?php
class ReplaceErrorCodeWithException extends PHPUnit_Framework_TestCase
{
    public function testItemsCanBeAddedAtWill()
    {
        $bag = new Bag(10);
        $result = $bag->addItem('Domain-Driven Design', 10);
        $this->assertEquals(10, $bag->getWeight());
    }

    public function testTheWeightLimitCannotBeInfringed()
    {
        $bag = new Bag(10);
        try {
            $result = $bag->addItem('Land of Lisp', 11);
            $this->fail('Adding the item should not be allowed.');
        } catch (TooMuchWeightException $e) {
            $this->assertEquals(0, $bag->getWeight());
        }
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
            throw new TooMuchWeightException("Weight has exceeded the limit for this Bag: $this->weightLimit");
        }
        $this->weight += $itemWeight;
        return 0;
    }

    public function getWeight()
    {
        return $this->weight;
    }
}

class TooMuchWeightException extends Exception {}
