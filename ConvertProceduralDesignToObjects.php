<?php
class ConvertProceduralDesignToObjects extends PHPUnit_Framework_TestCase
{
    public function testPricesAreSummedAfterAPercentageBasedTaxIsApplied()
    {
        $invoice = new Invoice(array(
            new Row(1000, 4),
            new Row(1000, 20),
            new Row(2000, 20),
        ));
        $this->assertEquals(4640, $invoice->total());
    }
}

class Invoice
{
    private $rows;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function total()
    {
        $total = 0;
        foreach ($this->rows as $row) {
            $total += $row->total();
        }
        return $total;
    }
}

class Row
{
    public function __construct($netPrice, $taxRate)
    {
        $this->netPrice = $netPrice;
        $this->taxRate = $taxRate;
    }

    public function total()
    {
        return $this->netPrice 
             + $this->taxRate * $this->netPrice / 100;
    }
}
