<?php
class IntroduceForeignMethod extends PHPUnit_Framework_TestCase
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
        $this->links = new ArrayObject();
    }

    public function add($url, $text)
    {
        $this->links[$url] = $text;
        $this->links->asort();
    }

    public function addUrl($url)
    {
        $this->links[$url] = $url;
        $this->links->asort();
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
