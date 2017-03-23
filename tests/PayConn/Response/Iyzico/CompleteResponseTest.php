<?php
namespace PayConn\Tests\Response\Iyzico;

use PayConn\Response\Iyzico\CompleteResponse;

/**
 * Class CompleteResponseTest
 * @package PayConn\Tests\Response\Iyzico
 */
class CompleteResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success response
     */
    public function testSuccessResponse()
    {
        $response = new CompleteResponse(['status' => 'success']);
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Test failed response
     */
    public function testFailedResponse()
    {
        $response = new CompleteResponse(['status' => 'failed', 'errorMessage' => 'error message', 'errorCode' => 'error code']);
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals('error message', $response->getMessage());
        $this->assertEquals('error code', $response->getCode());
    }
}