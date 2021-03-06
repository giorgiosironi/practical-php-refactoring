<?php
class ReplaceSubclassWithFields extends PHPUnit_Framework_TestCase
{
    public function testInternalLinkShouldRenderWithTheRightCssClass()
    {
        $a = new Link('/posts/32', 'Last post', 'myClass');
        $this->assertEquals('<a href="/posts/32" class="myClass">Last post</a>',
                            $a->__toString());
    }
}

class Link
{
    private $href;
    private $text;
    private $cssClass;

    public function __construct($href, $text, $cssClass)
    {
        $this->href = $href;
        $this->text = $text;
        $this->cssClass = $cssClass;
    }

    public static function internalLink($href, $text)
    {
        return new Link($href, $text, 'internal');
    }

    public static function externalLink($href, $text)
    {
        return new Link($href, $text, 'external');
    }

    public function __toString()
    {
        return '<a href="' . $this->href 
             . '" class="' . $this->cssClass . '">'
             . $this->text . '</a>';
    }
}
