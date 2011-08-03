<?php
class IntroduceLocalExtension extends PHPUnit_Framework_TestCase
{
    public function testLinksAreViewedInOrder()
    {
        $links = new LinkGroup();
        $links->addUrl('twitter.com');
        $links->add('plus.google.com', 'Google+');
        $links->add('facebook.com', 'Facebook');
        $expected = "<a href=\"facebook.com\">Facebook</a>\n"
                  . "<a href=\"plus.google.com\">Google+</a>\n"
                  . "<a href=\"twitter.com\">twitter.com</a>";
        $this->assertEquals($expected, $links->__toString());
    }
}

class LinkGroup
{
    private $links;

    public function __construct()
    {
        $this->links = new TextHeap();
    }

    public function add($url, $text)
    {
        $this->links->newLink($url, $text);
    }

    public function addUrl($url)
    {
        $this->links->newLink($url, $url);
    }

    public function __toString()
    {
        $links = array();
        foreach ($this->links as $url => $text) {
            $links[] = "<a href=\"$url\">$text</a>";
        }
        return implode("\n", $links);
    }
}

/**
 * From PHP 5.3, we can also use SplHeap and derivations.
 */
class TextHeap extends ArrayObject
{
    public function newLink($url, $text)
    {
        $this[$url] = $text;
        $this->asort();
    }

}
