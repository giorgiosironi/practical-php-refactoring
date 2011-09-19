<?php
class ReplaceTypeCodeWithClass extends PHPUnit_Framework_TestCase
{
    public function testAnUserCanBeANewbieOrAGuru()
    {
        $user = new User();
        $this->assertEquals(User::NEWBIE, $user->getRank());
        $user->setRank(User::GURU);
        $this->assertEquals(User::GURU, $user->getRank());
    }
}

class User
{
    const NEWBIE = 'N';
    const GURU = 'G';

    private $rank;

    public function __construct()
    {
        $this->rank = new Rank('N');
    }

    public function setRank($rank)
    {
        $this->rank = new Rank($rank);
    }

    public function getRank()
    {
        return $this->rank->getCode();
    }
}

class Rank
{
    private $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public static function newbie()
    {
        return new self('N');
    }

    public static function guru()
    {
        return new self('G');
    }
}
