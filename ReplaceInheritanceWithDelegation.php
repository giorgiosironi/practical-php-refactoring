<?php
class ReplaceInheritanceWithDelegation extends PHPUnit_Framework_TestCase
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
    /**
     * @return string   an HTML printable version
     */
    public function __toString()
    {
        return $this->display($this->displayedText(), $this->author);
    }

    public function display($text, $author)
    {
        return "$text -- $author";
    }
}

class Post
{
    private $text;
    private $author;
    private $format;

    public function __construct($text, $author)
    {
        $this->text = $text;
        $this->author = $author;
        $this->format = new TextSignedByAuthorFormat();
    }

    protected function displayedText()
    {
        return $this->text;
    }

    public function __toString()
    {
        return $this->format->display($this->displayedText(), $this->author);
    }
}

class Link
{
    private $url;
    private $author;
    private $format;

    public function __construct($url, $author)
    {
        $this->url = $url;
        $this->author = $author;
        $this->format = new TextSignedByAuthorFormat();
    }

    protected function displayedText()
    {
        return "<a href=\"$this->url\">$this->url</a>";
    }

    public function __toString()
    {
        return $this->format->display($this->displayedText(), $this->author);
    }
}

