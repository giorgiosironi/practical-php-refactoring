<?php
class ChangeValueToReference extends PHPUnit_Framework_TestCase
{
    public function testAuthorIsChanged()
    {
        $unknown = new Author('Unknown');
        $asimov = new Author('Asimov');

        $book = Book::fromTitleAndAuthor('Robots and empire', $unknown);
        $book->changeAuthor($asimov);
        $this->assertSame($asimov, $book->getAuthor());
    }
}

class Book
{
    private $title;
    private $author;

    /**
     * This is just a Factory Method providing a name to the constructor
     * for easier understanding. This method cannot execute new anymore.
     */
    public static function fromTitleAndAuthor($title, Author $author)
    {
        return new self($title, $author);
    }

    private function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
    }

    /**
     * Author is now a Reference/Entity, so it cannot be created with new. The
     * unique copy of Asimov or Unknown should be passed from the outside. 
     */
    public function changeAuthor($newAuthor)
    {
        $this->author = $newAuthor;
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
