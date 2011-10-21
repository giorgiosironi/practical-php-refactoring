<?php
class IntroduceNullObject extends PHPUnit_Framework_TestCase
{
    public function testAUserWithAGroupShowsHisAffiliation()
    {
        $user = new User('giorgio', new Group('Engineers'));
        $this->assertEquals('giorgio belongs to Engineers', $user->getDescription());
    }

    public function testAUserWithoutAGroupDoesNotHaveABadge()
    {
        $user = new User('giorgio', null);
        $this->assertEquals('giorgio does not belong to a group yet', $user->getDescription());
    }
}

class User
{
    private $name;
    private $group;

    public function __construct($name, Group $group = null)
    {
        $this->name = $name;
        $this->group = $group;
    }

    public function getDescription()
    {
        if ($this->group === null) {
            return $this->name . ' does not belong to a group yet';
        }
        return $this->name . ' belongs to ' . $this->group->getName();
    }
}

class Group
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
