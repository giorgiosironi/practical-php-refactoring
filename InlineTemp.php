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
    
    /**
     * We add an allowed overdraft as parameter.
     */
    public function testIsDisplayedAsMixedWhenNotTooMuchNegative()
    {
        $account = new AccountView(-20, 1000);
        $this->assertEquals('<div class="red">-20 (<span class="green">maximum overdraft: 1000</span>)</div>', $account->render());
    }
}

class AccountView
{
    private $total;

    public function __construct($total, $maximumOverdraft = 0)
    {
        $this->total = $total;
        $this->maximumOverdraft = $maximumOverdraft;
    }

    /**
     * This implementation doesn't work: $negative have different meanings in 
     * case of negative total or negative total larger than the maximum overdraft.
     */
    public function render()
    {
        $negative = $this->total < 0;
        $class =  $negative ? 'red' : 'green';
        if ($negative && $this->maximumOverdraft) {
            $overdraftNotice =" (<span class=\"$class\">maximum overdraft: $this->maximumOverdraft</span>)";
        } else {
            $overdraftNotice = '';
        }
        return "<div class=\"$class\">{$this->total}{$overdraftNotice}</div>";
    }
}
