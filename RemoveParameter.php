<?php
class RemoveParameter extends PHPUnit_Framework_TestCase
{
    public function testProvidesNextInvoiceNumbersForTheCurrentDate()
    {
        $invoices = new Invoices(array(1 => '2011-10-01', 2 => '2011-11-01'));
        $this->assertEquals(3, $invoices->getProgressiveNumberForInsertion());
    }
}

class Invoices
{
    private $invoiceDates;

    public function __construct($invoiceDates)
    {
        $this->invoiceDates = $invoiceDates;
    }

    public function getProgressiveNumberForInsertion()
    {
        $nextNumber = count($this->invoiceDates) + 1;
        return $nextNumber;
    }
}
