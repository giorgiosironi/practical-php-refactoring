<?php
class ReplaceTypeCodeWithClass extends PHPUnit_Framework_TestCase
{
    public function testAnUserCanBeANewbieOrAGuru()
    {
        $user = new User();
        $this->assertEquals(Rank::newbie(), $user->getRank());
        $user->setRank(Rank::guru());
        $this->assertEquals(Rank::guru(), $user->getRank());
    }
}

class User
{
    private $rank;

    public function __construct()
    {
        $this->rank = Rank::newbie();
    }

    public function setRank(Rank $rank)
    {
        $this->rank = $rank;
    }

    public function getRank()
    {
        return $this->rank;
    }
}

class Rank
{
    private $code;

    private function __construct($code)
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
