<?php
class CollapseHierarchy extends PHPUnit_Framework_TestCase
{
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
}

class Link extends NewsFeedItem
{
    public function toHtml()
    {
        return "<a href=\"$this->content\">$this->content</a> -- $this->author";
    }
}
