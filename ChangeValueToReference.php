<?php
class ChangeValueToReference extends PHPUnit_Framework_TestCase
{
    public function testAuthorIsChanged()
    {
        $book = Book::fromTitleAndAuthor('Robots and empire', 'Unknown');
        $book->changeAuthor('Asimov');
        $this->assertEquals('Asimov', $book->getAuthor()->__toString());
    }
}

class Book
{
    private $title;
    private $author;

    /**
     * This is just a Factory Method providing a name to the constructor
     * for easier understanding.
     */
    public static function fromTitleAndAuthor($title, $authorName)
    {
        return new self($title, new Author($authorName));
    }

    private function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
    }

    /**
     * Author is just a Value Object, so it can be created anywhere and 
     * multiple copies of the same author be spread between objects.
     */
    public function changeAuthor($newName)
    {
        $this->author = new Author($newName);
    }

    public function getAuthor()
    {
        return $this->author;
    }
}

/**
 * Author is a Value Object wrapping a string, although of course in reality
 * there would be other methods here, justifying its existence.
 */
class Author
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }
}
