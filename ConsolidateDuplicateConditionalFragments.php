<?php
class ConsolidateDuplicateConditionalFragments extends PHPUnit_Framework_TestCase
{
    public function testTotalPaymentIncludeTaxesAndProcessingFee()
    {
        $invoice = new Invoice(990, 21, false);
        $this->assertEquals(1210, $invoice->getTotal());
    }

    public function testTotalCanBeDiscountedBeforeTaxes()
    {
        $invoice = new Invoice(1250, 21, 20);
        $this->assertEquals(1210, $invoice->getTotal());
    }
}

class Invoice
{
    private $taxable;
    private $taxRate;
    private $discount;
    const PROCESSING_FEE = 10;

    public function __construct($taxable, $taxRate, $discount = false)
    {
        $this->taxable = $taxable;
        $this->taxRate = $taxRate;
        $this->discount = $discount;
    }

    public function getTotal()
    {
        if ($this->discount) {
            $total = $this->taxable * (1 - $this->discount / 100);
        } else {
            $total = $this->taxable + self::PROCESSING_FEE;
        }
        return $total * (1 + $this->taxRate / 100);
    }
}
