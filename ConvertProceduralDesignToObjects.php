<?php
class ConvertProceduralDesignToObjects extends PHPUnit_Framework_TestCase
{
    public function testPricesAreSummedAfterAPercentageBasedTaxIsApplied()
    {
        $invoice = new Invoice(array(
            array(1000, 4),
            array(1000, 20),
            array(2000, 20),
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
            $rowTotal = $row[0] 
                      + $row[0] * $row[1] / 100;
            $total += $rowTotal;
        }
        return $total;
    }
}
