<?php
class RenameMethod extends PHPUnit_Framework_TestCase
{
    public function testSimulatesClientCode()
    {
        $repository = new UserRepository();
        $this->assertEquals(0, $repository->numberOfUsersWithoutAPublicProfile());
    }
}

class UserRepository
{
    public function numberOfUsersWithoutAPublicProfile()
    {
        // ...complex calculations...
        return 0;
    }
}
