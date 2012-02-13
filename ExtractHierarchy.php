<?php
class ExtractHierarchy extends PHPUnit_Framework_TestCase
{
    public function testAnOrdinaryTopicDisplaysItsTitleAsNormalText()
    {
        $topic = new Topic('OOP in R');
        $this->assertEquals('<div class="title">OOP in R</div>', $topic->title());
    }

    public function testATopicInEvidenceDisplaysItselfAsStronger()
    {
        $topic = new Topic('OOP in R', true);
        $this->assertEquals('<div class="title"><strong>OOP in R</strong></div>', $topic->title());
    }
}

class Topic
{
    private $title;
    private $inEvidence;

    public function __construct($title, $inEvidence = false)
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
