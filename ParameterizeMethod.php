<?php
class ParameterizeMethod extends PHPUnit_Framework_TestCase
{
    public function testTheArticleIsConsideredPopularAfter1000Views()
    {
        $article = new Article('PPR: Extract Method', 1000);
        $this->assertTrue($article->isPopular());
    }

    public function testTheArticleIsConsideredInTheTopRankAfter10000Views()
    {
        $article = new Article('How to be a worse programmer', 10000);
        $this->assertTrue($article->isTop());
    }

    public function testPopularityIsDecidedByAViewsParameter()
    {
        $article = new Article('How to be a worse programmer', 10000);
        $this->assertTrue($article->isEnoughPopular(10000));
        $this->assertFalse($article->isEnoughPopular(10001));
    }
}

class Article
{
    private $title;
    private $views;

    public function __construct($title, $views)
    {
        $this->title = $title;
        $this->views = $views;
    }

    public function isEnoughPopular($minimumViews)
    {
        return $this->views >= $minimumViews;
    }

    public function isPopular()
    {
        return $this->views >= 1000;
    }

    public function isTop()
    {
        return $this->views >= 10000;
    }
}
