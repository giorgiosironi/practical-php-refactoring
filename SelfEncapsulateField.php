<?php
class SelfEncapsulateField extends PHPUnit_Framework_TestCase
{
    public function testParagraphIsDisplayed()
    {
        $p = new Paragraph('Lorem ipsum', 'important');
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
        return "<p class=\"$this->class\">$this->text</p>";
    }
}
