<?php
class RemoveMiddleMan extends PHPUnit_Framework_TestCase
{
    /**
     * In the previous example, we were delegating the activation logic to the
     * UserCollection, modeling only HTTP request-related concerns into our 
     * UserController.
     */
    public function testUserIsActivatedIfActivationTokenIsCorrect()
    {
        $userCollection = new UserCollection(array(
            'giorgio' => new User('giorgio', 42)
        ));
        $controller = new UserController($userCollection);
        $controller->activation(array(
            'name' => 'giorgio',
            'activationNumber' => 42
        ));
        $this->assertTrue($userCollection->getUser('giorgio')->isActive());
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
 * The Server: this class hides a User instance.
 */
class UserCollection
{
    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function getUser($name)
    {
        return $this->users[$name];
    }

    public function activationOfUser($name, $activationNumber)
    {
        $this->users[$name]->activate($activationNumber);
    }
}

/**
 * The Client.
 */
class UserController
{
    private $userCollection;

    public function __construct(UserCollection $collection)
    {
        $this->userCollection = $collection;
    }

    public function activation(array $request)
    {
        if (!isset($request['name'])) {
            throw new InvalidArgumentException('No user specified.');
        }
        if (!isset($request['activationNumber'])) {
            throw new InvalidArgumentException('No activation number.');
        }
        $this->userCollection->activationOfUser($request['name'], $request['activationNumber']);
    }
}
