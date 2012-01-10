<?php
class ExtractSuperclass extends PHPUnit_Framework_TestCase
{
    public function testAPostShowsItsAuthor()
    {
        $post = new Post("Hello, world!");
        $this->assertEquals("<p>Hello, world!</p>",
                            $post->toHtml());
    }

    public function testALinkShowsItsAuthor()
    {
        $link = new Link("/posts/php-refactoring");
        $this->assertEquals("<p><a href=\"/posts/php-refactoring\">/posts/php-refactoring</a></p>",
                            $link->toHtml());
    }
}

class Post
{
    public function __construct($text)
    {
        $this->text = $text;
    }

    public function toHtml()
    {
        return "<p>" . $this->text . "</p>";
    }
}

class Link
{
    public function __construct($href)
    {
        $this->href = $href;
    }

    public function toHtml()
    {
        return "<p><a href=\"" . $this->href . "\">" . $this->href . "</a></p>";
    }
}
