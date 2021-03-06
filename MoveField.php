<?php
class MoveMethodTest extends PHPUnit_Framework_TestCase
{
    public function testDisplayItsLinksInShortForm()
    {
        $tagCloud = new TagCloud(array(
            new Link('http://giorgiosironi.blogspot.com/search/label/productivity'),
            new Link('http://giorgiosironi.blogspot.com/search/label/software%20development')
        ), 'archives');
        $html = $tagCloud->toHtml();
        $this->assertEquals(
            "<a href=\"http://giorgiosironi.blogspot.com/search/label/productivity\" rel=\"archives\">productivity</a>\n"
          . "<a href=\"http://giorgiosironi.blogspot.com/search/label/software%20development\" rel=\"archives\">software development</a>\n",
            $html
        );
    }
}

class TagCloud
{
    private $links;
    private $rel;

    public function __construct(array $links, $rel)
    {
        $this->links = $links;
        $this->rel = $rel;
    }

    public function toHtml()
    {
        $html = '';
        foreach ($this->links as $link) {
            $text = $link->text();
            $html .= "<a href=\"$link\" rel=\"$this->rel\">$text</a>\n";
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

    public function text()
    {
        $lastFragment = substr(strrchr($this, '/'), 1);
        return str_replace('%20', ' ', $lastFragment);
    }
}
