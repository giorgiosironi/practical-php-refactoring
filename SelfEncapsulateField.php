<?php
class SelfEncapsulateField extends PHPUnit_Framework_TestCase
{
    public function testParagraphIsDisplayed()
    {
        $p = new Paragraph('Lorem ipsum', 'important');
        $expected = '<p class="important">Lorem ipsum</p>';
        $this->assertEquals($expected, $p->__toString());
    }

    public function testParagraphIsDisplayedAsAlwaysImportant()
    {
        $p = new ImportantParagraph('Lorem ipsum');
        $expected = '<p class="important">Lorem ipsum</p>';
        $this->assertEquals($expected, $p->__toString());
    }
}

class Paragraph
{
    private $text;
    private $class;

    public function __construct($text, $class)
    {
        $this->text = $text;
        $this->class = $class;
    }

    public function __toString()
    {
        return "<p class=\"" . $this->getClass() . "\">$this->text</p>";
    }

    protected function getClass()
    {
        return $this->class;
    }
}

class ImportantParagraph extends Paragraph
{
    /**
     * This constructor is an hack, but at least the Liskov Substitution 
     * Principle is respected in the external interface, which only
     * consists of __toString().
     * If we want to improve this constructor, we can extract a common 
     * abstract class between Paragraph and ImportantParagraph, so that
     * both can have their own constructors.
     */
    public function __construct($text)
    {
        parent::__construct($text, null);
    }
   
    protected function getClass()
    {
        return 'important';
    }
}
