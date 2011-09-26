<?php
class ReplaceTypeCodeWithSubclasses extends PHPUnit_Framework_TestCase
{
    public function testAnUserCanBeANewbie()
    {
        $user = new User("Giorgio", User::NEWBIE);
        $this->assertEquals("Giorgio", $user->__toString());
    }

    public function testAnUserCanBeRegardedAsAGuru()
    {
        $user = new User("Giorgio", User::GURU);
        $this->assertEquals("ADMIN: Giorgio", $user->__toString());
    }
}

class User
{
    const NEWBIE = 'N';
    const GURU = 'G';

    private $name;
    private $rank;

    public function __construct($name, $rank)
    {
        $this->name = $name;
        $this->rank = $rank;
    }

    public function __toString()
    {
        if ($this->rank == self::GURU) {
            return "ADMIN: $this->name";
        }
        // self::NEWBIE
        return $this->name;
    }
}
