<?php
class ReplaceArrayWithObjectTest extends PHPUnit_Framework_TestCase
{
    public function testCanDefineAnHttpResponse()
    {
        $response = new HttpResponse(array(
            'success' => true,
            'content' => '{someJson:"ok"}'
        ));
        $response->setSuccess(false);
        $response->setContent('{}');
        $this->assertEquals(new HttpResponse(array(
            'success' => false,
            'content' => '{}'
        )), $response);
    }
}

class HttpResponse
{
    private $success;
    private $content;

    public function __construct(array $data)
    {
        $this->setSuccess($data['success']);
        $this->setContent($data['content']);
    }

    public function setSuccess($boolean)
    {
        $this->success = $boolean;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
}
