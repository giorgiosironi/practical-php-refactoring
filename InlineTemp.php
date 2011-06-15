<?php
class AccountViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * I know, CSS classes named with colors are a smell. But we're focusing
     * on the PHP side for now.
     * This test checks that AccountView visualizes the amount of money
     * in it as red when appropriate. We'll change this requirement and as
     * a result perform a refactoring.
     */
    public function testIsDisplayedAsRedWhenNegative()
    {
        $account = new AccountView(-20);
        $this->assertEquals('<div class="red">-20</div>', $account->render());
    }
}

class AccountView
{
    private $total;

    public function __construct($total)
    {
        $this->total = $total;
    }

    public function render()
    {
        $negative = $this->total < 0;
        $class =  $negative ? 'red' : 'green';
        return "<div class=\"$class\">$this->total</div>";
    }
}
