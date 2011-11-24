<?php
class ReplaceParameterWithMethod extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $thread = new Thread();
        $thread->add(new Post('Hello...'));
        $thread->add(new Post('Hi!'));
        $this->assertEquals("Hello...\n\n> In reply to: Hello...\nHi!\n\n", $thread->__toString());
    }
}

class Thread
{
    private $posts = array();
    private $lastPost = null;

    /**
     * Sets up a linked list of Post objects in addition to the array.
     * We assume this kind of traversal is already in place for other reasons
     * or collaborations between Post objects.
     */
    public function add(Post $post) 
    {
        $this->posts[] = $post;
        $post->setOrigin($this->lastPost);
        $this->lastPost = $post;
    }

    /**
     * This method contains mechanics that duplicate the linked list.
     */
    public function __toString()
    {
        $previousPost = null;
        $text = '';
        foreach ($this->posts as $post) {
            $text .= $post->__toString();
            $text .= "\n";
            $previousPost = $post;
        }
        return $text;
    }
}

class Post
{
    private $text;
    private $origin;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function setOrigin(Post $post = null)
    {
        $this->origin = $post;
    }

    public function __toString() {
        if ($this->origin) {
            $text = '> In reply to: ' . $this->origin->text . "\n";
        } else {
            $text = '';
        }
        $text .= $this->text . "\n";
        return $text;
    }
}
