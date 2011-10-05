<?php
class ConsolidateConditionalExpression extends PHPUnit_Framework_TestCase
{
    public function testAGroupIsInEvidenceWhenManyPostsArePresent()
    {
        $group = new Group('PHP forum', 100);
        $this->assertEquals('<span class="evidence">In evidence: PHP forum</span>', $group->__toString());
    }

    public function testAGroupIsShownAsNormalWhenThereAreNotManyPosts()
    {
        $group = new Group('PHP forum', 10);
        $this->assertEquals('<span>PHP forum</span>', $group->__toString());
    }

    public function testAGroupIsAlsoInEvidenceWhenItHasBeenRecentlyCreated()
    {
        $group = new Group('PHP forum', 0, true);
        $this->assertEquals('<span class="evidence">In evidence: PHP forum</span>', $group->__toString());
    }
}

class Group
{
    private $name;
    private $posts;
    private $recentlyCreated;

    public function __construct($name, $posts, $recentlyCreated = false)
    {
        $this->name = $name;
        $this->posts = $posts;
        $this->recentlyCreated = $recentlyCreated;
    }

    public function __toString()
    {
        if ($this->isInEvidence()) {
            return "<span class=\"evidence\">In evidence: $this->name</span>";
        } 
        return "<span>$this->name</span>";
    }

    private function isInEvidence()
    {
        return $this->posts > 50 || $this->recentlyCreated;
    }
}
