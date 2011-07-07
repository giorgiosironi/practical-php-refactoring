<?php
class PhonebookTest extends PHPUnit_Framework_TestCase
{
    public function testPrintsNameAndNumberOrderedByName()
    {
        $phonebook = new Phonebook();
        $phonebook->add('Giorgio', '031...');
        $phonebook->add('Adam', '021...');
        $phonebook->add('Zend', '045...');
        $html = $phonebook->toHtml();
        $this->assertEquals(
            "<ul>\n"
          . "<li>Adam: 021...</li>\n"
          . "<li>Giorgio: 031...</li>\n"
          . "<li>Zend: 045...</li>\n"
          . "</ul>\n",
          $html
        );
    }
}

class Phonebook
{
    private $numbers = array();

    public function add($name, $number)
    {
        $this->numbers[$name] = $number;
    }

    /**
     * I thought about writing a sorting algorithm, but...
     * I opted to use a different, bundled sorting algorithm :)
     */
    public function toHtml()
    {
        $names = array_keys($this->numbers);
        sort($names);
        foreach ($names as $name) {
            $numbers[$name] = $this->numbers[$name];
        }
        $this->numbers = $numbers;

        $html = "<ul>\n";
        foreach ($this->numbers as $name => $number) {
            $html .= "<li>$name: $number</li>\n";
        }
        $html .= "</ul>\n";
        return $html;
    }
}
