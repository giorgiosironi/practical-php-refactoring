<?php
class ReplaceTypeCodeWithSubclasses extends PHPUnit_Framework_TestCase
{
    public function testAnUserCanBeANewbie()
    {
        $user = User::newUser("Giorgio", User::NEWBIE);
        $this->assertEquals("Giorgio", $user->__toString());
    }

    public function testAnUserCanBeRegardedAsAGuru()
    {
        $user = User::newUser("Giorgio", User::GURU);
        $this->assertEquals("ADMIN: Giorgio", $user->__toString());
    }
}

class User
{
    const NEWBIE = 'N';
    const GURU = 'G';

    protected $name;
    private $rank;

    public function __construct($name, $rank)
    {
        $this->name = $name;
        $this->rank = $rank;
    }

    public static function newUser($name, $rank)
    {
        if ($rank == self::GURU) {
            return new Guru($name, null);
        }
        return new Newbie($name, null);
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

class Guru extends User
{
    protected function getRank()
    {
        return self::GURU;
    }
}

class Newbie extends User
{
    protected function getRank()
    {
        return self::NEWBIE;
    }
}
