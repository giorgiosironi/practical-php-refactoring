<?php
class ReplaceArrayWithObjectTest extends PHPUnit_Framework_TestCase
{
    public function testCanDefineAnHttpResponse()
    {
        $response = array(
            'success' => true,
            'content' => '{someJson:"ok"}'
        );
    }
}

