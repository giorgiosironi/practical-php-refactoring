<?php
class InlineMethodTest extends PHPUnit_Framework_TestCase
{
    public function testMethodExtractionShouldNotMakeThisTestFail()
    {
        $logParser = new LogParser();
        $logLine = '127.0.0.1 - - [04/30/2011:17:07:31 +0200] "GET /favicon.ico HTTP/1.1" 404 450 "-" "Mozilla"';
        $day = $logParser->getDayOfTheWeek($logLine);
        $this->assertEquals('On Saturday we got a visit from 127.0.0.1', $day);
    }
}

class LogParser
{
    public function getDayOfTheWeek($logLine)
    {
        preg_match('/([0-9.]*) (.*)([0-9]{2}\/[0-9]{2}\/[0-9]{4})/', $logLine, $matches);
        $ip = $matches[1];
        $date = new DateTime($matches[3]);
        return 'On ' . $date->format('l') . ' we got a visit from ' . $ip;
    }
}
