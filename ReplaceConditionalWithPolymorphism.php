<?php
class ReplaceConditionalWithPolymorphism extends PHPUnit_Framework_TestCase
{
    public function testAUserProfileShouldHaveAStandardURL()
    {
        $renderer = new Renderer(new User('giorgio'));
        $this->assertEquals('<a href="/giorgio">giorgio</a>', $renderer->__toString());
    }

    public function testABrandPageShouldHaveACustomURL()
    {
        $renderer = new Renderer(new Brand('Coca Cola', 'coke'));
        $this->assertEquals('<a href="/coke">Coca Cola</a>', $renderer->__toString());
    }
}

abstract class Addressable
{
    public abstract function render($template);
}

class User extends Addressable
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render($template)
    {
        return sprintf($template, $this->name, $this->name);
    }
}

class Brand extends Addressable
{
    private $name;
    private $url;

    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    public function render($template)
    {
        return sprintf($template, $this->url, $this->name);
    }
}

class Renderer
{
    private $domainObject;

    public function __construct($domainObject)
    {
        $this->domainObject = $domainObject;
    }

    public function __toString()
    {
        return $this->domainObject->render('<a href="/%s">%s</a>');
    }
}
