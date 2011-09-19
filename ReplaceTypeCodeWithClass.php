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

    private $rank = 'N';

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function getRank()
    {
        return $this->rank;
    }
}
