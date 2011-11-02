<?php
class AddParameter extends PHPUnit_Framework_TestCase
{
    public function testProvidesNextInvoiceNumbersForTheCurrentDate()
    {
        $invoices = new Invoices(array(1 => '2011-10-01', 2 => '2011-11-01'));
        $this->assertEquals(3, $invoices->getNextProgressiveNumber());
    }

    public function testNextInvoiceNumberIsAnExistingOneInCaseWeHaveToRenumerate()
    {
        $invoices = new Invoices(array(1 => '2011-10-01', 2 => '2011-11-10'));
        $this->assertEquals(2, $invoices->getNextProgressiveNumber());
    }
}

class Invoices
{
    private $invoiceDates;

    public function __construct($invoiceDates)
    {
        $this->invoiceDates = $invoiceDates;
    }

    public function getNextProgressiveNumber()
    {
        $currentDate = date('Y-m-d');
        foreach ($this->invoiceDates as $number => $date) {
            if ($date > $currentDate) {
                $nextNumber = $number;
                break;
            }
        }
        if (!isset($nextNumber)) {
            $nextNumber = count($this->invoiceDates) + 1;
        }
        return $nextNumber;
    }
}
