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
    private $heap;

    public function __construct()
    {
        $this->heap = new TextHeap();
    }

    public function add($url, $text)
    {
        $this->heap->addElement($url, $text);
    }

    public function addUrl($url)
    {
        $this->heap->addElement($url, $url);
    }

    public function __toString()
    {
        $links = array();
        foreach ($this->heap as $url => $text) {
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
    public function addElement($key, $text)
    {
        $this[$key] = $text;
        $this->asort();
    }

}
