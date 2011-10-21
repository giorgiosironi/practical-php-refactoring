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
        $user = new User('giorgio', new NoGroup);
        $this->assertEquals('giorgio does not belong to a group yet', $user->getDescription());
    }
}

class User
{
    private $name;
    private $group;

    public function __construct($name, Group $group)
    {
        $this->name = $name;
        $this->group = $group;
    }

    public function getDescription()
    {
        return $this->group->belonging($this->name);
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

    public function belonging($name)
    {
        return $name . ' belongs to ' . $this->name;
    }
}

class NoGroup extends Group
{
    public function __construct() {}

    public function belonging($name)
    {
        return $name . ' does not belong to a group yet';
    }
}
