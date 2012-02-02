<?php
class TeaseApartInheritance extends PHPUnit_Framework_TestCase
{
    public function testAFacebookPostIsDisplayedWithTextAndLinkToTheAuthor()
    {
        $post = new Post("Enjoy!", new FacebookSource("PHP-Cola"));
        $this->assertEquals("<p>Enjoy!"
                          . " -- <a href=\"http://facebook.com/PHP-Cola\">PHP-Cola</a></p>",
                            $post->__toString());
    }

    public function testAFacebookLinkIsDisplayedWithTargetAndLinkToTheAuthor()
    {
        $link = new Link("Our new ad", "http://youtube.com/...", new FacebookSource("PHP-Cola"));
        $this->assertEquals("<p><a href=\"http://youtube.com/...\">Our new ad</a>"
                          . " -- <a href=\"http://facebook.com/PHP-Cola\">PHP-Cola</a></p>",
                            $link->__toString());
    }

    public function testATwitterLinkIsDisplayedWithTargetAndLinkToTheAuthor()
    {
        $link = new Link("Our new ad", "http://youtube.com/...", new TwitterSource("giorgiosironi"));
        $this->assertEquals("<p><a href=\"http://youtube.com/...\">Our new ad</a>"
                          . " -- <a href=\"http://twitter.com/giorgiosironi\">@giorgiosironi</a></p>",
                            $link->__toString());
    }
}

abstract class NewsFeedItem
{
    protected $author;
    protected $source;

    public function __toString()
    {
        return "<p>"
             . $this->content()
             . " -- "
             . $this->source->authorLink()
             . "</p>";
    }

    /**
     * @return string
     */
    protected abstract function content();
}

abstract class Source
{
    public function __construct($author)
    {
        $this->author = $author;
    }

    public abstract function authorLink();
}

class FacebookSource extends Source
{
    public function authorLink()
    {
        return "<a href=\"http://facebook.com/$this->author\">$this->author</a>";
    }
}

class TwitterSource extends Source
{
    public function authorLink()
    {
        return "<a href=\"http://twitter.com/$this->author\">@$this->author</a>";
    }
}

class Post extends NewsFeedItem
{
    private $content;

    public function __construct($content, Source $source)
    {
        $this->content = $content;
        $this->source = $source;
    }

    protected function content()
    {
        return $this->content;
    }
}

class Link extends NewsFeedItem
{
    private $url;
    private $linkText;

    public function __construct($linkText, $url, Source $source)
    {
        $this->linkText = $linkText;
        $this->url = $url;
        $this->source = $source;
    }

    protected function content()
    {
        return "<a href=\"$this->url\">$this->linkText</a>";
    }
}
