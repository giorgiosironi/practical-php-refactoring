<?php
class ExtractHierarchy extends PHPUnit_Framework_TestCase
{
    public function testAnOrdinaryTopicDisplaysItsTitleAsNormalText()
    {
        $topic = Topic::fromFields('OOP in R');
        $this->assertEquals('<div class="title">OOP in R</div>', $topic->title());
    }

    public function testATopicInEvidenceDisplaysItselfAsStronger()
    {
        $topic = Topic::fromFields('OOP in R', true);
        $this->assertEquals('<div class="title"><strong>OOP in R</strong></div>', $topic->title());
    }
}

class Topic
{
    protected $title;
    protected $inEvidence;

    public static function fromFields($title, $inEvidence = false)
    {
        if ($inEvidence) {
            return new InEvidenceTopic($title, $inEvidence);
        } else {
            return new OrdinaryTopic($title, $inEvidence);
        }
    }

    private function __construct($title, $inEvidence)
    {
        $this->title = $title;
        $this->inEvidence = $inEvidence;
    }

    public function title()
    {
        $title = '<div class="title">';
        $title .= $this->decoratedTitleText();
        $title .= '</div>';
        return $title;
    }

    protected function decoratedTitleText()
    {
        if ($this->inEvidence) {
            return "<strong>$this->title</strong>";
        } else {
            return $this->title;
        }
    }
}

class OrdinaryTopic extends Topic
{
    protected function decoratedTitleText()
    {
        if ($this->inEvidence) {
            return "<strong>$this->title</strong>";
        } else {
            return $this->title;
        }
    }
}

class InEvidenceTopic extends Topic
{
    protected function decoratedTitleText()
    {
        if ($this->inEvidence) {
            return "<strong>$this->title</strong>";
        } else {
            return $this->title;
        }
    }
}
