<?php
class ReplaceMagicNumberWithSymbolicConstant extends PHPUnit_Framework_TestCase
{
    private $totalCards;

    public function setUp()
    {
        $this->totalCards = Deck::SUITS * Deck::RANGE;
    }

    public function testDeckIsFilledWithCardsInitially()
    {
        $deck = new Deck();
        $this->assertEquals($this->totalCards, count($deck));
    }

    public function testDeckCanDrawAllItsCards()
    {
        $deck = new Deck();
        for ($i = 0; $i < $this->totalCards; $i++) {
            $card = $deck->draw();
            $this->assertGreaterThanOrEqual(1, $card);
            $this->assertLessThanOrEqual(Deck::RANGE, $card);
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
        for ($i = 0; $i < self::SUITS; $i++) {
            $this->cards = array_merge($this->cards, range(1, self::RANGE));
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
