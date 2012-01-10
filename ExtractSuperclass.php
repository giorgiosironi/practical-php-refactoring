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

abstract class ParagraphBox
{
}

class Post extends ParagraphBox
{
    public function __construct($content)
    {
        $this->content = $content;
    }

    private function displayContent()
    {
        return $this->content;
    }

    public function toHtml()
    {
        return "<p>" . $this->displayContent() . "</p>";
    }
}

class Link extends ParagraphBox
{
    public function __construct($content)
    {
        $this->content = $content;
    }

    private function displayContent()
    {
        return "<a href=\"$this->content\">$this->content</a>";
    }

    public function toHtml()
    {
        return "<p>" . $this->displayContent() . "</p>";
    }
}
