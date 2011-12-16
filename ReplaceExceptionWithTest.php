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

    public function __construct($driver, $restOfDsn)
    {
        try {
            $dsn = $driver . ':' . $restOfDsn;
            $this->connection = new PDO($dsn);
        } catch (PDOException $e) {
            throw new DatabaseException("The connection was not successful: check the configuration (dsn: '$dsn').");
        }
    }
}

class DatabaseException extends Exception {}
