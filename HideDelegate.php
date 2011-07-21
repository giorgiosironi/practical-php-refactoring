<?php
class HideDelegate extends PHPUnit_Framework_TestCase
{
    /**
     * We are imagine an User is registered and an activation number is sent
     * via mail to him. This test regards the activation process enacted
     * by a user following a link in the mail.
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
 * The Delegate: This class contains the business logic.
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
 * The Server: this class hands out a User instance.
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
}

/**
 * The Client: this class gets an User instance and calls a method on it,
 * violating the Law of Demeter.
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
        $user = $this->userCollection->getUser($request['name']);
        $user->activate($request['activationNumber']);
    }
}
