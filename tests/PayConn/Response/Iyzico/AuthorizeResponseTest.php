<?php
namespace PayConn\Tests\Response\Iyzico;

use PayConn\Response\Iyzico\AuthorizeResponse;

/**
 * Class AuthorizeResponseTest
 * @package PayConn\Tests\Response\Iyzico
 */
class AuthorizeResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success response
     */
    public function testSuccessResponse()
    {
        $response = new AuthorizeResponse(['status' => 'success', 'threeDSHtmlContent' => 'content']);
        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals('content', $response->getHtmlContent());
    }

    /**
     * Test failed response
     */
    public function testFailedResponse()
    {
        $response = new AuthorizeResponse(['status' => 'failed', 'errorMessage' => 'error message', 'errorCode' => 'error code']);
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals('error message', $response->getMessage());
        $this->assertEquals('error code', $response->getCode());
    }
}