<?php
class ExtractInterface extends PHPUnit_Framework_TestCase
{
    public function testShouldDisplayAMoneyAmount()
    {
        $locale = new EuroLocale();
        $money = new Money("42");
        $this->assertEquals("42 &euro;", $money->display($locale));
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
