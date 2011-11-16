<?php
class ParameterizeMethod extends PHPUnit_Framework_TestCase
{
    public function testTheArticleIsConsideredPopularAfter1000Views()
    {
        $article = new Article('PPR: Extract Method', 1000);
        $this->assertTrue($article->isEnoughPopular(Article::POPULAR));
    }

    public function testTheArticleIsConsideredInTheTopRankAfter10000Views()
    {
        $article = new Article('How to be a worse programmer', 10000);
        $this->assertTrue($article->isEnoughPopular(Article::TOP));
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
    const POPULAR = 1000;
    const TOP = 10000;

    public function __construct($title, $views)
    {
        $this->title = $title;
        $this->views = $views;
    }

    public function isEnoughPopular($minimumViews)
    {
        return $this->views >= $minimumViews;
    }
}
