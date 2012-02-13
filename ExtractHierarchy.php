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
    private $title;
    private $inEvidence;

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
        if ($this->inEvidence) {
            $title .= "<strong>$this->title</strong>";
        } else {
            $title .= $this->title;
        }
        $title .= '</div>';
        return $title;
    }
}

class OrdinaryTopic extends Topic
{
}

class InEvidenceTopic extends Topic
{
}
