<?php
class ReplaceDataValueWithObject extends PHPUnit_Framework_TestCase
{
    public function testUserCanSetANewPassword()
    {
        $userService = new UserService(/* other dependencies*/);
        $userService->newPassword(array(
            'userId' => 42,
            'oldPassword' => 'gismo',
            'newPassword' => 'supersecret',
            'repeatNewPassword' => 'supersecret'
        ));
        $this->markTestIncomplete('This refactoring is about the introduction of an object; it suffices that the test does not explode.');
    }
}

class UserService
{
    public function newPassword($changePasswordData)
    {
        /* it's not interesting to do something here */
    }
}
