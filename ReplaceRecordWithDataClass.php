<?php
/**
 * The test case works as an example of client code, as always.
 */
class ReplaceRecordWithDataClass extends PHPUnit_Framework_TestCase
{
    public function testShowContainedData()
    {
        $users = new UsersTable();
        $giorgio = $users->find(42);
        $this->assertEquals('Giorgio', $giorgio['name']);
    }
}

/**
 * This is a Fake Table Data Gateway. The machinery for making it work with
 * a database will be distracting for our purposes, so they will be omitted.
 */
class UsersTable
{
    /**
     * @return mixed    the returned value can be a Zend_Db_Table_Row,
     *                  an Active Record, a stdClass, an associative array...
     *                  It should just represent a single entity.
     */
    public function find($id)
    {
        // execute a PDOStatement and fetch the data
        return array('id' => 42, 'name' => 'Giorgio');
    }
}
