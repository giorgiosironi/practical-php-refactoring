<?php
class MoveMethodTest extends PHPUnit_Framework_TestCase
{
    public function testDisplayItsLinksInShortForm()
    {
        $tagCloud = new TagCloud(array(
            new Link('http://giorgiosironi.blogspot.com/search/label/productivity'),
            new Link('http://giorgiosironi.blogspot.com/search/label/software%20development')
        ));
        $html = $tagCloud->toHtml();
        $this->assertEquals(
            "<a href=\"http://giorgiosironi.blogspot.com/search/label/productivity\">productivity</a>\n"
          . "<a href=\"http://giorgiosironi.blogspot.com/search/label/software%20development\">software development</a>\n",
            $html
        );
    }
}

class TagCloud
{
    private $links;

    public function __construct(array $links)
    {
        $this->links = $links;
    }

    public function toHtml()
    {
        $html = '';
        foreach ($this->links as $link) {
            $text = $link->text();
            $html .= "<a href=\"$link\">$text</a>\n";
        }
        return $html;
    }
}

class Link
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function __toString()
    {
        return $this->url;
    }

    /**
     * The movement change the method in many ways:
     * - simpler name
     * - public visibility 
     * - one less parameter
     * The refactoring makes Link a behavior-rich Value Object, but this is 
     * incidental; if I could have moved a method that used an external 
     * service from Link to TagCloud. However, in these samples I have a 
     * limited space and often many of my objects are Value Objects just 
     * because I wanted to post running examples, and they are a really
     * portable kind of code.
     */
    public function text()
    {
        $lastFragment = substr(strrchr($this, '/'), 1);
        return str_replace('%20', ' ', $lastFragment);
    }
}
