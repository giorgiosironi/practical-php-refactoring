<?php
class ExtractClassTest extends PHPUnit_Framework_TestCase
{
    public function testDisplaysMoneyInAHumanFormat()
    {
        // using strings for representation to avoid loss of precision
        $moneyAmount = new MoneySpan(new MoneyAmount('100'));
        $this->assertEquals('<span class="money">100.00</span>', $moneyAmount->toHtml());
    }
}

class MoneySpan
{
    /**
     * @param int $amount
     */
    public function __construct(MoneyAmount $amount)
    {
        $this->amount = $amount;
    }

    public function toHtml()
    {
        $html = '<span class="money">' . $this->amount->format() . '</span>';
        return $html;
    }
}

class MoneyAmount
{
    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function format()
    {
        return $this->amount . '.00';
    }
}
