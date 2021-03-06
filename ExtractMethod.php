<?php
class ExtractMethodTest extends PHPUnit_Framework_TestCase
{
    public function testMethodExtractionShouldNotMakeThisTestFail()
    {
        $logParser = new LogParser();
        $logLine = '127.0.0.1 - - [04/30/2011:17:07:31 +0200] "GET /favicon.ico HTTP/1.1" 404 450 "-" "Mozilla"';
        $day = $logParser->getDayOfTheWeek($logLine);
        $this->assertEquals('On Saturday we got a visit', $day);
    }
}

class LogParser
{
    public function getDayOfTheWeek($logLine)
    {
        $date = $this->getDate($logLine);
        return 'On ' . $date->format('l') . ' we got a visit';
    }

    /**
     * @return DateTime
     */
    private function getDate($logLine)
    {
        preg_match('([0-9]{2}/[0-9]{2}/[0-9]{4})', $logLine, $matches);
        return new DateTime($matches[0]);
    }
}
