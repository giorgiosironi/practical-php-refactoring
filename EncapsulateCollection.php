<?php
class EncapsulateCollection extends PHPUnit_Framework_TestCase
{
    public function testCollectionCanBePopulatedAndInspected()
    {
        $user = new User();
        $user->addGroup(new Group('sysadmins'));
        $user->addGroup(new Group('developers'));
        $user->addGroup(new Group('economists'));
        $this->assertEquals(3, count($user->getGroups()));
    }
}

class User
{
    private $groups;

    public function __construct()
    {
        $this->groups = new ArrayObject();
    }

    public function addGroup(Group $group)
    {
        $this->groups->append($group);
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups->getArrayCopy();
    }
}

/**
 * A simple Value Object in this example, little more than a string.
 */
class Group
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
