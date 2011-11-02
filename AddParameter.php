<?php
class AddParameter extends PHPUnit_Framework_TestCase
{
    public function testProvidesNextInvoiceNumbersForTheCurrentDate()
    {
        $invoices = new Invoices(array(1 => '2011-10-01', 2 => '2011-11-01'));
        $this->assertEquals(3, $invoices->getProgressiveNumberForInsertion('2011-11-02'));
    }

    public function testNextInvoiceNumberIsAnExistingOneInCaseWeHaveToRenumerate()
    {
        $invoices = new Invoices(array(1 => '2011-10-01', 2 => '2011-11-10'));
        $this->assertEquals(2, $invoices->getProgressiveNumberForInsertion('2011-11-02'));
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
        return $this->getProgressiveNumberForInsertion($currentDate);
    }

    public function getProgressiveNumberForInsertion($currentDate)
    {
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
