<?php
class ExtractInterface extends PHPUnit_Framework_TestCase
{
    public function testShouldFormatItsAmountBeforeDisplayingIt()
    {
        $locale = $this->getMock('Locale');
        $locale->expects($this->once())->method('format')->with("42")->will($this->returnValue('42 SIMBOL'));
        $money = new Money("42");
        $this->assertEquals("42 SIMBOL", $money->display($locale));
    }

    public function testShouldFormatAnAmountWithTheEuroSighn()
    {
        $locale = new EuroLocale();
        $this->assertEquals("42 &euro;", $locale->format("42"));
    }
}

interface Locale
{
    /**
     * @return string
     */
    public function format($amount);
}

class EuroLocale implements Locale
{
    public function format($amount)
    {
        return $amount . ' &euro;';
    }
}

class Money
{
    private $amount;

    /**
     * @param string $amount    to keep precision
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function display(Locale $locale)
    {
        return $locale->format($this->amount);
    }
}
