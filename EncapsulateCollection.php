<?php
class EncapsulateCollection extends PHPUnit_Framework_TestCase
{
    public function testCollectionCanBePopulatedAndInspected()
    {
        $user = new User();
        $groups = new ArrayObject(array(
            new Group('sysadmins'),
            new Group('developers'),
            new Group('economists')
        ));
        $user->setGroups($groups);
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

    public function setGroups(ArrayObject $groups)
    {
        $this->groups = $groups;
    }

    public function getGroups()
    {
        return $this->groups;
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
