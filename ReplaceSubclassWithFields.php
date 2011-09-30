<?php
class ReplaceSubclassWithFields extends PHPUnit_Framework_TestCase
{
    public function testInternalLinkShouldRender()
    {
        $a = Link::internalLink('/posts/32', 'Last post');
        $this->assertEquals('<a href="/posts/32" class="internal">Last post</a>',
                            $a->__toString());
    }

    public function testExternalLinkShouldRender()
    {
        $a = Link::externalLink('http://www.google.com', 'Google');
        $this->assertEquals('<a href="http://www.google.com" class="external">Google</a>',
                            $a->__toString());
    }
}

abstract class Link
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
        return new InternalLink($href, $text, 'internal');
    }

    public static function externalLink($href, $text)
    {
        return new ExternalLink($href, $text, 'external');
    }

    public function __toString()
    {
        return '<a href="' . $this->href 
             . '" class="' . $this->getCssClass() . '">'
             . $this->text . '</a>';
    }

    abstract protected function getCssClass();
}

class InternalLink extends Link
{
    public function getCssClass()
    {
        return 'internal';
    }
}

class ExternalLink extends Link
{
    public function getCssClass()
    {
        return 'external';
    }
}
