<?php
class PushDownField extends PHPUnit_Framework_TestCase
{
    public function testAPostShowsItsAuthor()
    {
        $post = new Post("Hello, world!", "giorgiosironi");
        $this->assertEquals("Hello, world! -- @giorgiosironi",
                            $post->__toString());
    }

    public function testALinkShowsItsAuthor()
    {
        $link = new Link("/posts/php-refactoring", "giorgiosironi");
        $this->assertEquals("<a href=\"/posts/php-refactoring\">/posts/php-refactoring</a> -- @giorgiosironi",
                            $link->__toString());
    }
}

abstract class NewsFeedItem
{
    /**
     * @var string  references the author's Twitter username
     */
    protected $author;

    /**
     * @var string
     */
    protected $url;

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

    /**
     * @var string
     */
    protected $url;

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
    /**
     * @var string
     */
    protected $url;

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
