<?php
class ReplaceExceptionWithTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException DatabaseException
     */
    public function testTheConnectionIsNotCreatedIfTheDriverIsNotSupported()
    {
        $database = new Database('somecloneofsqlite', ':memory:');
    }
}

class Database
{
    private $connection;
    private $supportedDrivers = array('sqlite', 'mysql');

    public function __construct($driver, $restOfDsn)
    {
        $dsn = $driver . ':' . $restOfDsn;
        if (!in_array($driver, $this->supportedDrivers)) {
            throw new DatabaseException("The connection was not successful: check the configuration (dsn: '$dsn').");
        }
        try {
            $this->connection = new PDO($dsn);
        } catch (PDOException $e) {
            throw new DatabaseException("The connection was not successful: check the configuration (dsn: '$dsn').");
        }
    }
}

class DatabaseException extends Exception {}
