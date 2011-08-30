<?php
class ChangeBidirectionalAssociationToUnidirectional extends PHPUnit_Framework_TestCase
{
    public function testPhonenumbersDoNotNeedToReferToUsers()
    {
        $user = new User('Giorgio');
        $user->addPhonenumber(new Phonenumber('012345'));
        $this->assertEquals("012345\n", $user->phonenumbersList());
    }
}

class User
{
    private $name;
    private $phonenumbers;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addPhonenumber(Phonenumber $phonenumber)
    {
        $this->phonenumbers[] = $phonenumber;
        $phonenumber->internalSetUser($this);
    }

    public function phonenumbersList()
    {
        $list = '';
        foreach ($this->phonenumbers as $number) {
            $list .= "$number\n";
        }
        return $list;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Phonenumber
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function internalSetUser(User $u)
    {
    }

    public function __toString()
    {
        return $this->number;
    }
}
