<?php
class ReplaceNestedConditionalWithGuardClauses extends PHPUnit_Framework_TestCase
{
    public function testTheOpenTopicTitleIsDisplayedNormally()
    {
         $topic = new Topic("Hello");
         $this->assertEquals("Hello", $topic->__toString());
    }

    public function testTheClosedTopicTitleIsDisplayedWithACorrespondingIndication()
    {
         $topic = new Topic("Hello", true);
         $this->assertEquals("Closed: Hello", $topic->__toString());
    }

    public function testTheClosedTopicTitleIsDisplayedNormallyToAdmins()
    {
         $topic = new Topic("Hello", true, true);
         $this->assertEquals("Closed (not for you): Hello", $topic->__toString());
    }
}

class Topic
{
    private $title;
    private $isClosed;
    private $isAdminViewing;

    public function __construct($title, $isClosed = false, $isAdminViewing = false)
    {
        $this->title = $title;
        $this->isClosed = $isClosed;
        $this->isAdminViewing = $isAdminViewing;
    }

    public function __toString()
    {
        if ($this->isClosed && $this->isAdminViewing) {
            return "Closed (not for you): $this->title";
        }
        if ($this->isClosed) {
            return "Closed: $this->title";
        }
        if (!$this->isClosed) {
            $displayed = $this->title;
        } else {
            if ($this->isAdminViewing) {
            } else {
            }
        }
        return $displayed;
    }
}
