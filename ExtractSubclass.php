<?php
class ExtractSubclass extends PHPUnit_Framework_TestCase
{
    public function testAPostShowsItsAuthor()
    {
        $post = new NewsFeedItem("Hello, world!", "giorgiosironi");
        $this->assertEquals("Hello, world! -- @giorgiosironi",
                            $post->__toString());
    }

    public function testALinkShowsItsAuthor()
    {
        $link = new Link("/posts/php-refactoring", "giorgiosironi");
        $this->assertEquals("<a href=\"/posts/php-refactoring\">/posts/php-refactoring</a> -- @giorgiosironi",
                            $link->toHtml());
    }
}

class NewsFeedItem
{
    protected $content;
    protected $author;

    public function __construct($content, $author)
    {
        $this->content = $content;
        $this->author = '@' . ltrim($author, '@');
    }

    /**
     * @return string   an HTML printable version
     */
    public function __toString()
    {
        return "$this->content -- $this->author";
    }

    public function toHtml()
    {
        return "<a href=\"$this->content\">$this->content</a> -- $this->author";
    }
}

class Link extends NewsFeedItem
{
}
