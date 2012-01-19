<?php
class FormTemplateMethod extends PHPUnit_Framework_TestCase
{
    public function testAVideoTweet()
    {
        $link = new VideoTweet('http://www.youtube.com/watch?...', "Lolcats");
        $this->assertEquals('Check out this video: Lolcats http://www.youtube.com/watch?...',
                            $link->__toString());
    }

    public function testAnArticleTweet()
    {
        $link = new ArticleTweet('http://css.dzone.com/category/tags/practical-php-refactoring', "Practical PHP Refactoring");
        $this->assertEquals('RT @DZone: Practical PHP Refactoring http://css.dzone.com/category/tags/practical-php-refactoring',
                            $link->__toString());
    }
}

class Tweet
{
    protected $url;
    protected $title;

    public function __construct($url, $title)
    {
        $this->url = $url;
        $this->title = $title;
    }
}

class VideoTweet extends Tweet
{
    public function __toString()
    {
        return $this->prefix() . ": $this->title $this->url";
    }

    protected function prefix()
    {
        return "Check out this video";
    }
}

class ArticleTweet extends Tweet
{
    public function __toString()
    {
        return $this->prefix() . ": $this->title $this->url";
    }

    protected function prefix()
    {
        return "RT @DZone";
    }
}
