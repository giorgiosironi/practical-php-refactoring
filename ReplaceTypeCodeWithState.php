<?php
class ReplaceTypeCodeWithState extends PHPUnit_Framework_TestCase
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

    protected function getRank()
    {
        return $this->rank;
    }

    public function __toString()
    {
        if ($this->getRank() == self::GURU) {
            return "ADMIN: $this->name";
        }
        // self::NEWBIE
        return $this->name;
    }
}

class Rank
{
    public abstract function getCode();
}
