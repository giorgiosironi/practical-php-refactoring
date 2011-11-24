<?php
class RemoveSettingMethod extends PHPUnit_Framework_TestCase
{
    public function testAQuestionIsDisplayedTogetherWithTheNumberOfResponses()
    {
        $question = new Question('How do I install PHP on the washing machine?', 10);
        $this->assertEquals('How do I install PHP on the washing machine? (responses: 10)', $question->__toString());
    }
}

class Question
{
    private $text;
    private $responses;

    public function __construct($text, $responses = 0)
    {
        $this->setText($text);
        $this->responses = $responses;
    }

    public function setText($text)
    {
        $text = trim($text);
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->text . ' (responses: ' . $this->responses . ')';
    }
}
