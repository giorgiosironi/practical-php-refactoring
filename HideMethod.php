<?php
class HideMethod extends PHPUnit_Framework_TestCase
{
    public function testTheBookIsRenderedCorrectly()
    {
        $book = new BookInfo('Robots and Empire', 'Asimov');
        $this->assertEquals('<li>Robots and Empire <em>(Asimov)</em></li>', $book->__toString());
    }
}

class BookInfo
{
    private $title;
    private $author;

    public function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
    }

    public function __toString()
    {
        $authorInfo = $this->authorHtml();
        return "<li>$this->title $authorInfo</li>";
    }

    public function authorHtml()
    {
        return "<em>($this->author)</em>";
    }
}
