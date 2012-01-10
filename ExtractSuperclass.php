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
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    abstract protected function displayContent();

    public function toHtml()
    {
        return "<p>" . $this->displayContent() . "</p>";
    }
}

class Post extends ParagraphBox
{
    protected function displayContent()
    {
        return $this->content;
    }

}

class Link extends ParagraphBox
{
    protected function displayContent()
    {
        return "<a href=\"$this->content\">$this->content</a>";
    }
}
