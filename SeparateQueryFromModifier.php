<?php
class SeparateQueryFromModifier extends PHPUnit_Framework_TestCase
{
    public function testTheDomainObjectProvidesACalculatedField()
    {
        $user = new User('Giorgio', 'Sironi');
        $this->assertEquals('User: Giorgio Sironi', $user->__toString());
    }

    public function testTheDomainObjectQueriesShouldNotModifyTheObservableStateOfTheObjectItself()
    {
        $user = new User('Giorgio', 'Sironi');
        $oldFullName = $user->getFullName();
        $user->__toString();
        $this->assertEquals($oldFullName, $user->getFullName());
    }
}

/**
 * @Entity
 */
class User
{
    /**
     * @Column
     */
    private $firstName;
    /**
     * @Column
     */
    private $lastName;
    /**
     * @Column
     */
    private $fullName;

    public function __construct($first, $last)
    {
        $this->firstName = $first;
        $this->lastName = $last;
        $this->completeFields();
    }

    public function getFirstName() { return $this->firstName; }
    public function getLastName() { return $this->lastName; }
    public function getFullName() { return $this->fullName; }

    private function completeFields()
    {
        $this->fullName = $this->firstName . ' ' . $this->lastName;
    }

    public function __toString()
    {
        return 'User: ' . $this->fullName;
    }
}
