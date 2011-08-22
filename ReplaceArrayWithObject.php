<?php
class ReplaceArrayWithObjectTest extends PHPUnit_Framework_TestCase
{
    public function testCanDefineAnHttpResponse()
    {
        $response = new HttpResponse(array(
            'success' => true,
            'content' => '{someJson:"ok"}'
        ));
    }
}

class HttpResponse
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
