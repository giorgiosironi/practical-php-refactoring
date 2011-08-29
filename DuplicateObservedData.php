<?php
class DuplicateObservedData extends PHPUnit_Framework_TestCase
{
    public function testTheTotalMustBeDisplayed()
    {
        $invoice = new Invoice();
        $invoice->addRow(100);
        $invoice->addRow(50);
        $invoiceView = new InvoiceView($invoice);
        // simplified representation to avoid cluttering this example with HTML
        $this->assertEquals("100\n50\n---\n150", $invoiceView->__toString());
    }
}

class Invoice
{
    private $rows = array();

    public function addRow($amount)
    {
        $this->rows[] = $amount;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function getTotal()
    {
        return array_sum($this->rows);
    }
}

class InvoiceView
{
    private $rows;
    private $total;

    public function __construct(Invoice $invoice)
    {
        $this->rows = $invoice->getRows();
        $this->total = $invoice->getTotal();
    }

    public function __toString()
    {
        return implode("\n", $this->rows)
             . "\n---\n"
             . $this->total;
    }
}
