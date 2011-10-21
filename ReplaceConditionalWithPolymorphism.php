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

class User 
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Brand 
{
    private $name;
    private $url;

    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getURL()
    {
        return $this->url;
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
        if ($this->domainObject instanceof User)
        {
            return '<a href="/' . $this->domainObject->getName() . '">' . $this->domainObject->getName() . '</a>';
        }
        if ($this->domainObject instanceof Brand)
        {
            return '<a href="/' . $this->domainObject->getURL() . '">' . $this->domainObject->getName() . '</a>';
        }
    }
}
