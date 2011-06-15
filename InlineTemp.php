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
     * We get rid of $negative and inline. Since the code now sucks, we're ready
     * for other refactorings that weren't possible while referring to
     * $negative: it contained too few information for us to display the right
     * colors.
     */
    public function render()
    {
        $class =  $this->total < 0 ? 'red' : 'green';
        if ($this->maximumOverdraft && $this->total < 0) {
            $overDraftClass = 'green'; // this will become a computed value after we add more tests
            $overdraftNotice =" (<span class=\"green\">maximum overdraft: $this->maximumOverdraft</span>)";
        } else {
            $overdraftNotice = '';
        }
        return "<div class=\"$class\">{$this->total}{$overdraftNotice}</div>";
    }
}
