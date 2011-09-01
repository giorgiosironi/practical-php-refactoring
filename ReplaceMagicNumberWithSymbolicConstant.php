<?php
class ReplaceMagicNumberWithSymbolicConstant extends PHPUnit_Framework_TestCase
{
    public function testDeckIsFilledWithCardsInitially()
    {
        $deck = new Deck();
        $this->assertEquals(52, count($deck));
    }

    public function testDeckCanDrawAllItsCards()
    {
        $deck = new Deck();
        for ($i = 0; $i < 52; $i++) {
            $card = $deck->draw();
            $this->assertGreaterThanOrEqual(1, $card);
            $this->assertLessThanOrEqual(13, $card);
        }
        $this->assertEquals(0, count($deck));
    }
}

class Deck implements Countable
{
    const RANGE = 13;
    const SUITS = 4;
    private $cards;

    public function __construct()
    {
        $this->cards = array();
        for ($i = 0; $i < 4; $i++) {
            $this->cards = array_merge($this->cards, range(1, 13));
        }
    }
    public function count()
    {
        return count($this->cards);
    }

    public function draw()
    {
        return array_shift($this->cards);
    }
}
