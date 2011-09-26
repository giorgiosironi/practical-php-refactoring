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

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function newUser($name, $rank)
    {
        if ($rank == self::GURU) {
            return new Guru($name);
        }
        return new Newbie($name);
    }

    protected function getRank()
    {
        return $this->rank;
    }
}

class Guru extends User
{
    protected function getRank()
    {
        return self::GURU;
    }

    public function __toString()
    {
        return "ADMIN: $this->name";
    }
}

class Newbie extends User
{
    protected function getRank()
    {
        return self::NEWBIE;
    }

    public function __toString()
    {
        return $this->name;
    }
}
