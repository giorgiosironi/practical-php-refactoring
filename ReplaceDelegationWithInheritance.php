<?php
class ReplaceDelegationWithInheritance extends PHPUnit_Framework_TestCase
{
    public function testAPostShowsItsAuthor()
    {
        $post = new Post("Hello, world!", "giorgiosironi");
        $this->assertEquals("Hello, world! -- giorgiosironi",
                            $post->__toString());
    }

    public function testALinkShowsItsAuthor()
    {
        $link = new Link("http://en.wikipedia.com", "giorgiosironi");
        $this->assertEquals("<a href=\"http://en.wikipedia.com\">http://en.wikipedia.com</a> -- giorgiosironi",
                            $link->__toString());
    }
}

class TextSignedByAuthorFormat
{
    private $text;
    private $author;

    public function __construct($text, $author)
    {
        $this->text = $text;
        $this->author = $author;
    }

    public function __toString()
    {
        return "$this->text -- $this->author";
    }
}

class Post extends TextSignedByAuthorFormat {}

class Link extends TextSignedByAuthorFormat
{
    public function __construct($url, $author)
    {
        parent::__construct($this->displayedText($url), $author);
    }

    protected function displayedText($url)
    {
        return "<a href=\"$url\">$url</a>";
    }
}
