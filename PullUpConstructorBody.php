<?php
class PullUpConstructorBody extends PHPUnit_Framework_TestCase
{
    public function testAPostShowsItsAuthor()
    {
        $post = new Post("Hello, world!", "giorgiosironi");
        $this->assertEquals("Hello, world! -- @giorgiosironi",
                            $post->__toString());
    }

    public function testALinkShowsItsAuthor()
    {
        $link = new Link("http://en.wikipedia.com", "giorgiosironi");
        $this->assertEquals("<a href=\"http://en.wikipedia.com\">http://en.wikipedia.com</a> -- @giorgiosironi",
                            $link->__toString());
    }
}

abstract class NewsFeedItem
{
    /**
     * @var string  references the author's Twitter username
     */
    protected $author;

    public function __construct($author)
    {
        $this->author = '@' . ltrim($author, '@');
    }

    /**
     * @return string   an HTML printable version
     */
    public function __toString()
    {
        return $this->displayedText() . " -- $this->author";
    }

    /**
     * @return string
     */
    protected abstract function displayedText();
}

class Post extends NewsFeedItem
{
    private $text;

    public function __construct($text, $author)
    {
        parent::__construct($author);
        $this->text = $text;
    }

    protected function displayedText()
    {
        return $this->text;
    }
}

class Link extends NewsFeedItem
{
    private $url;

    public function __construct($url, $author)
    {
        parent::__construct($author);
        $this->url = $url;
    }

    protected function displayedText()
    {
        return "<a href=\"$this->url\">$this->url</a>";
    }
}
