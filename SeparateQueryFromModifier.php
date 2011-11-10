<?php
class SeparateQueryFromModifier extends PHPUnit_Framework_TestCase
{
    public function testTheDomainObjectProvidesACalculatedField()
    {
        $user = new User('Giorgio', 'Sironi');
        $this->assertEquals('User: Giorgio Sironi', $user->__toString());
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
    }

    public function getFirstName() { return $this->firstName; }
    public function getLastName() { return $this->lastName; }
    public function getFullName() { return $this->fullName; }

    public function __toString()
    {
        $this->fullName = $this->firstName . ' ' . $this->lastName;
        return 'User: ' . $this->fullName;
    }
}
