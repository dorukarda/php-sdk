<?php
namespace PayConn\Tests\Response\Iyzico;

use PayConn\Response\Iyzico\RefundResponse;

/**
 * Class RefundResponseTest
 * @package PayConn\Tests\Response\Iyzico
 */
class RefundResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success response
     */
    public function testSuccessResponse()
    {
        $response = new RefundResponse(['status' => 'success']);
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Test failed response
     */
    public function testFailedResponse()
    {
        $response = new RefundResponse(['status' => 'failed', 'errorMessage' => 'error message', 'errorCode' => 'error code']);
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals('error message', $response->getMessage());
        $this->assertEquals('error code', $response->getCode());
    }
}