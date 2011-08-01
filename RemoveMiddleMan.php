<?php
class RemoveMiddleMan extends PHPUnit_Framework_TestCase
{
    /**
     * The User is now directly injected (it may be found at construction time.)
     * We maintain the reference to the object in the test for verification
     * purposes; this test has become a unit test and we could even use a Mock.
     */
    public function testUserIsActivatedIfActivationTokenIsCorrect()
    {
        $controller = new UserController($user = new User('giorgio', 42));
        $controller->activation(array(
            'activationNumber' => 42
        ));
        $this->assertTrue($user->isActive());
    }
}

/**
 * The Delegate: this class contains the business logic.
 */
class User
{
    private $name;
    private $activationNumber;
    private $active = false;

    public function __construct($name, $activationNumber)
    {
        $this->name = $name;
        $this->activationNumber = $activationNumber;
    }

    public function activate($number)
    {
        if ($this->activationNumber == $number) {
            $this->active = true;
        }
    }

    public function isActive()
    {
        return $this->active;
    }
}

/**
 * The Client now only refers to an User object since it does not have any 
 * other use for UserCollection.
 */
class UserController
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function activation(array $request)
    {
        if (!isset($request['activationNumber'])) {
            throw new InvalidArgumentException('No activation number.');
        }
        $this->user->activate($request['activationNumber']);
    }
}
