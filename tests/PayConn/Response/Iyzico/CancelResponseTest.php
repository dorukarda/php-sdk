<?php
namespace PayConn\Tests\Response\Iyzico;

use PayConn\Response\Iyzico\CancelResponse;

/**
 * Class CancelResponseTest
 * @package PayConn\Tests\Response\Iyzico
 */
class CancelResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success response
     */
    public function testSuccessResponse()
    {
        $response = new CancelResponse(['status' => 'success']);
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Test failed response
     */
    public function testFailedResponse()
    {
        $response = new CancelResponse(['status' => 'failed', 'errorMessage' => 'error message', 'errorCode' => 'error code']);
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals('error message', $response->getMessage());
        $this->assertEquals('error code', $response->getCode());
    }
}