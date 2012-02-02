<?php
class TeaseApartInheritance extends PHPUnit_Framework_TestCase
{
    public function testAFacebookPostIsDisplayedWithTextAndLinkToTheAuthor()
    {
        $post = new FacebookPost("Enjoy!", "PHP-Cola");
        $this->assertEquals("<p>Enjoy!"
                          . " -- <a href=\"http://facebook.com/PHP-Cola\">PHP-Cola</a></p>",
                            $post->__toString());
    }

    public function testAFacebookLinkIsDisplayedWithTargetAndLinkToTheAuthor()
    {
        $link = new FacebookLink("Our new ad", "http://youtube.com/...", "PHP-Cola");
        $this->assertEquals("<p><a href=\"http://youtube.com/...\">Our new ad</a>"
                          . " -- <a href=\"http://facebook.com/PHP-Cola\">PHP-Cola</a></p>",
                            $link->__toString());
    }

    public function testATwitterLinkIsDisplayedWithTargetAndLinkToTheAuthor()
    {
        $link = new TwitterLink("Our new ad", "http://youtube.com/...", "giorgiosironi");
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

abstract class Post extends NewsFeedItem
{
    private $content;

    public function __construct($content, $author)
    {
        $this->content = $content;
        $this->author = $author;
        $this->init();
    }

    protected function content()
    {
        return $this->content;
    }
}

abstract class Link extends NewsFeedItem
{
    private $url;
    private $linkText;

    public function __construct($linkText, $url, $author)
    {
        $this->linkText = $linkText;
        $this->url = $url;
        $this->author = $author;
        $this->init();
    }

    protected function content()
    {
        return "<a href=\"$this->url\">$this->linkText</a>";
    }
}

class FacebookPost extends Post
{
    public function init() { $this->source = new FacebookSource($this->author); }
}

class TwitterLink extends Link
{
    public function init() { $this->source = new TwitterSource($this->author); }
}

class FacebookLink extends Link
{
    public function init() { $this->source = new FacebookSource($this->author); }
}
