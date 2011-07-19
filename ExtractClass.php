<?php
class ExtractClassTest extends PHPUnit_Framework_TestCase
{
    public function testDisplaysMoneyInAHumanFormat()
    {
        // using strings for representation to avoid loss of precision
        $moneyAmount = new MoneySpan('10000');
        $this->assertEquals('<span class="money">10,000.00</span>', $moneyAmount->toHtml());
    }
}

class MoneySpan
{
    /**
     * @param int $amount
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function toHtml()
    {
        $html = '<span class="money">' . $this->format() . '</span>';
        return $html;
    }

    private function format()
    {
        $amount = $this->amount;
        $formatted = '';
        while (strlen($amount) > 3) {
            $cut = strlen($amount) % 3;
            $cut = $cut == 0 ? 3 : $cut;
            $formatted .= substr($amount, 0, $cut) . ',';
            $amount = substr($amount, $cut);
        }
        return $formatted . $amount . '.00';
    }
}

class MoneyAmount
{
}