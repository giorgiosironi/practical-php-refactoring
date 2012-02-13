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

abstract class Topic
{
    protected $title;

    public static function fromFields($title, $inEvidence = false)
    {
        if ($inEvidence) {
            return new InEvidenceTopic($title);
        } else {
            return new OrdinaryTopic($title);
        }
    }

    private function __construct($title)
    {
        $this->title = $title;
    }

    public function title()
    {
        $title = '<div class="title">';
        $title .= $this->decoratedTitleText();
        $title .= '</div>';
        return $title;
    }

    /**
     * @return string
     */
    abstract protected function decoratedTitleText();
}

class OrdinaryTopic extends Topic
{
    protected function decoratedTitleText()
    {
        return $this->title;
    }
}

class InEvidenceTopic extends Topic
{
    protected function decoratedTitleText()
    {
        return "<strong>$this->title</strong>";
    }
}
