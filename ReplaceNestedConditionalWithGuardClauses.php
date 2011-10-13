<?php
class ReplaceNestedConditionalWithGuardClauses extends PHPUnit_Framework_TestCase
{
    public function testTheOpenTopicTitleIsDisplayedNormally()
    {
         $topic = new Topic("Hello", new OpenTopicState);
         $this->assertEquals("Hello", $topic->__toString());
    }

    public function testTheClosedTopicTitleIsDisplayedWithACorrespondingIndication()
    {
         $topic = new Topic("Hello", new ClosedTopicState);
         $this->assertEquals("Closed: Hello", $topic->__toString());
    }

    public function testTheClosedTopicTitleIsDisplayedNormallyToAdmins()
    {
         $topic = new Topic("Hello", new ClosedTopicState, true);
         $this->assertEquals("Closed (not for you): Hello", $topic->__toString());
    }
}

class Topic
{
    private $title;
    private $isClosed;
    private $isAdminViewing;

    public function __construct($title, TopicState $isClosed, $isAdminViewing = false)
    {
        $this->title = $title;
        $this->isClosed = $isClosed;
        $this->isAdminViewing = $isAdminViewing;
    }

    public function __toString()
    {
        return $this->isClosed->topicCaption($this->isAdminViewing)
             . $this->title;
    }
}

interface TopicState
{
    /**
     * @return string
     */
    function topicCaption($isAdminViewing);
}

class OpenTopicState implements TopicState
{
    function topicCaption($isAdminViewing)
    {
        return '';
    }
}

class ClosedTopicState implements TopicState
{
    function topicCaption($isAdminViewing)
    {
        if ($isAdminViewing) {
            return 'Closed (not for you): ';
        }
        return 'Closed: ';
    }
}
