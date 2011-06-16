<?php
class LoginFormTest extends PHPUnit_Framework_TestCase
{
    public function testFormDisplaysOldUsernameValue()
    {
        $form = new LoginForm(array('username' => 'giorgio'));
        $html = $form->__toString();
        $this->assertTrue((bool) strstr($html, '<input type="text" name="username" value="giorgio" />'));
    }
}


/**
 * For brevity, we implement only the code necessary for the current test 
 * to pass.
 */
class LoginForm
{
    private $data;

    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    public function __toString()
    {
        $this->doSomethingWithTheUsername();
        return "...<input type=\"text\" name=\"username\" value=\"" . $this->getUsername() . "\" />...";
    }

    private function getUsername()
    {
        if (isset($this->data['username'])) {
            return $this->data['username'];
        } else {
            return '';
        } 
    }

    private function doSomethingWithTheUsername()
    {
        $this->getUsername();
        // this method is only here to provide an example of code
        // that will start utilizing the Query instead of the Temp
    }
}
