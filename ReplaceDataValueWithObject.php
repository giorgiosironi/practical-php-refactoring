<?php
class ReplaceDataValueWithObject extends PHPUnit_Framework_TestCase
{
    public function testUserCanSetANewPassword()
    {
        $userService = new UserService(/* other dependencies*/);
        $userService->newPassword(new ChangePasswordCommand(array(
            'userId' => 42,
            'oldPassword' => 'gismo',
            'newPassword' => 'supersecret',
            'repeatNewPassword' => 'supersecret'
        )));
        $this->markTestIncomplete('This refactoring is about the introduction of an object; it suffices that the test does not explode.');
    }
}

class UserService
{
    public function newPassword(ChangePasswordCommand $changePasswordData)
    {
        /* it's not interesting to do something here */
    }
}

class ChangePasswordCommand extends ArrayObject
{
    public function __construct($data)
    {
        if (!isset($data['userId'])) {
            throw new Exception('User id is missing.');
        }
        parent::__construct($data);
    }

    public function getPassword()
    {
        if ($this['newPassword'] != $this['repeatNewPassword']) {
            throw new Exception('Password do not match.');
        }
        return $this['newPassword'];
    }
}
