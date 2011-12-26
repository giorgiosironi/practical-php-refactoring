<?php
class PullUpField extends PHPUnit_Framework_TestCase
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

abstract class NewsFeedItem
{
    /**
     * @var string  references the author's Twitter username
     */
    protected $author;
}

class Post extends NewsFeedItem
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

class Link extends NewsFeedItem
{
    private $url;
    private $author;

    public function __construct($url, $author)
    {
        $this->url = $url;
        $this->author = $author;
    }

    public function __toString()
    {
        return "<a href=\"$this->url\">$this->url</a> -- $this->author";
    }
}
