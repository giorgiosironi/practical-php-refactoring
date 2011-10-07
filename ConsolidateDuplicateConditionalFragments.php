<?php
class ConsolidateDuplicateConditionalFragments extends PHPUnit_Framework_TestCase
{
    public function testTotalPaymentIncludeTaxesAndProcessingFee()
    {
        $invoice = new Invoice(990, 21, new ProcessingFee);
        $this->assertEquals(1210, $invoice->getTotal());
    }

    public function testTotalCanBeDiscountedBeforeTaxes()
    {
        $invoice = new Invoice(1250, 21, new PercentageDiscount(20));
        $this->assertEquals(1210, $invoice->getTotal());
    }
}

interface PaymentModifier
{
    public function applyOn($amount);
}

class PercentageDiscount implements PaymentModifier
{
    private $rate;

    public function __construct($rate)
    {
        $this->rate = $rate;
    }

    public function applyOn($amount)
    {
        return $amount * (1 - $this->rate / 100);
    }
}

class ProcessingFee implements PaymentModifier
{
    const PROCESSING_FEE = 10;

    public function applyOn($amount)
    {
        return $amount + self::PROCESSING_FEE;
    }
}

class Invoice
{
    private $taxable;
    private $taxRate;
    private $paymentModifier;

    public function __construct($taxable, $taxRate, PaymentModifier $paymentModifier)
    {
        $this->taxable = $taxable;
        $this->taxRate = $taxRate;
        $this->paymentModifier = $paymentModifier;
    }

    public function getTotal()
    {
        $total = $this->paymentModifier->applyOn($this->taxable);
        return $total * (1 + $this->taxRate / 100);
    }
}
