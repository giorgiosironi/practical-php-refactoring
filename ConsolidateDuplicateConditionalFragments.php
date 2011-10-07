<?php
class ConsolidateDuplicateConditionalFragments extends PHPUnit_Framework_TestCase
{
    public function testTotalPaymentIncludeTaxesAndProcessingFee()
    {
        $invoice = new Invoice(990, 21, new Discount(false));
        $this->assertEquals(1210, $invoice->getTotal());
    }

    public function testTotalCanBeDiscountedBeforeTaxes()
    {
        $invoice = new Invoice(1250, 21, new Discount(20));
        $this->assertEquals(1210, $invoice->getTotal());
    }
}

class Discount
{
    private $rate;
    const PROCESSING_FEE = 10;

    public function __construct($rate)
    {
        $this->rate = $rate;
    }

    public function discount($amount)
    {
        if ($this->rate) {
            return $amount * (1 - $this->rate / 100);
        } else {
            return $amount + self::PROCESSING_FEE;
        }
    }
}

class Invoice
{
    private $taxable;
    private $taxRate;
    private $discount;

    public function __construct($taxable, $taxRate, Discount $discount)
    {
        $this->taxable = $taxable;
        $this->taxRate = $taxRate;
        $this->discount = $discount;
    }

    public function getTotal()
    {
        $total = $this->discount->discount($this->taxable);
        return $total * (1 + $this->taxRate / 100);
    }
}
