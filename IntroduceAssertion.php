<?php
class IntroduceAssertion extends PHPUnit_Framework_TestCase
{
    public function testTaxesAreAddedToTheNetPrice()
    {
        $price = new Price(1000);
        $price->addTaxRate(20);
        $this->assertEquals(1200, $price->value());
    }

    public function testTaxesCanBeLoweredBy10PerCentAtTheTime()
    {
        $price = new Price(1000);
        $price->addTaxRate(20);
        $price->lowerTaxRate();
        $price->lowerTaxRate();
        $this->assertEquals(1000, $price->value());
    }

    public function testTaxesCannotBeLoweredBelowZeroForAValidPrice()
    {
        $price = new Price(1000);
        $price->addTaxRate(20);
        $price->lowerTaxRate();
        $price->lowerTaxRate();
        $price->lowerTaxRate();
        $this->setExpectedException('AssertionException');
        $price->value();
    }
}

class Price
{
    private $net;
    private $taxRate;

    public function __construct($net)
    {
        $this->net = $net;
    }

    public function addTaxRate($rate)
    {
        $this->taxRate = $rate;
    }

    public function lowerTaxRate()
    {
        $this->taxRate -= 10;
    }

    public function value()
    {
        return $this->net * (1 + $this->taxRate / 100);
    }
}
