<?php
class IntroduceParameterObject extends PHPUnit_Framework_TestCase
{
    public function testTaxesInformationDriveTheQuotationsTotalAndTypeFields()
    {
        $quotation = new Quotation();
        $quotation->addRow(1000);
        $quotation->specifyTaxes(20, 'VATCODE');
        $this->assertEquals(1200, $quotation->getTotal());
        $this->assertEquals('Type: VATCODE', $quotation->getTypeOfService());
    }
}

class Quotation
{
    private $netTotal = 0;
    private $vatPercentage;
    private $vatCode;

    public function addRow($row)
    {
        // including just the logic to implement the test we have
        $this->netTotal += $row;
    }

    public function specifyTaxes($percentage, $code)
    {
        $this->vatPercentage = $percentage;
        $this->vatCode = $code;
    }

    public function getTotal()
    {
        return $this->netTotal * (1 + $this->vatPercentage / 100); 
    }

    public function getTypeOfService()
    {
        return 'Type: ' . $this->vatCode;
    }
}


