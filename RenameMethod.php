<?php
class RenameMethod extends PHPUnit_Framework_TestCase
{
    public function testSimulatesClientCode()
    {
        $repository = new UserRepository();
        $this->assertEquals(0, $repository->snafucatedUsers());
    }
}

class UserRepository
{
    public function snafucatedUsers()
    {
        // ...complex calculations...
        return 0;
    }

    public function numberOfUsersWithoutAPublicProfile()
    {
        // ...complex calculations...
        return 0;
    }
}
