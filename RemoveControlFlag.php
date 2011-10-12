<?php
class RemoveControlFlag extends PHPUnit_Framework_TestCase
{
    public function testFindsTheUserWhoseNameIsShortEnough() {
        $users = new Users(array('Giorgio', 'John', 'Tim'));
        $user = $users->findUserWithNameAsShortAs(3);
        $this->assertEquals('Tim', $user);
    }
}

class Users
{
    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function findUserWithNameAsShortAs($length)
    {
        foreach ($this->users as $user) {
            if (strlen($user) == $length) {
                return $user;
            }
        }
    }

