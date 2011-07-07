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
            $text = $this->linkText($link);
            $html .= "<a href=\"$link\">$text</a>\n";
        }
        return $html;
    }
    
    private function linkText(Link $link)
    {
        $lastFragment = substr(strrchr($link, '/'), 1);
        return str_replace('%20', ' ', $lastFragment);
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
}
