<?php
class ExtractClassTest extends PHPUnit_Framework_TestCase
{
    public function testDisplaysMoneyInAHumanFormat()
    {
        // using strings for representation to avoid loss of precision
        $moneyAmount = new MoneySpan('100');
        $this->assertEquals('<span class="money">100.00</span>', $moneyAmount->toHtml());
    }
}

class MoneySpan
{
    /**
     * @param int|string $amount
     * The constructor now takes the arguments of the inline class, too.
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * This method must not refer to the collaborator anymore,
     * but to the imported methods.
     */
    public function toHtml()
    {
        $html = '<span class="money">' . $this->format() . '</span>';
        return $html;
    }

    /**
     * The public format() method of the inline class has been included as
     * a private method. We could go on and inline this method in toHtml()
     * as well.
     */
    private function format()
    {
        return $this->amount . '.00';
    }
}
