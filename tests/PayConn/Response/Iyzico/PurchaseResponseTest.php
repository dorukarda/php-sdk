<?php
namespace PayConn\Tests\Response\Iyzico;

use PayConn\Response\Iyzico\PurchaseResponse;

/**
 * Class PurchaseResponseTest
 * @package PayConn\Tests\Response\Iyzico
 */
class PurchaseResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success response
     */
    public function testSuccessResponse()
    {
        $response = new PurchaseResponse(['status' => 'success', 'paymentId' => 123]);
        $this->assertEquals(true, $response->isSuccessful());
        $this->assertEquals(123, $response->getReferenceId());
    }

    /**
     * Test failed response
     */
    public function testFailedResponse()
    {
        $response = new PurchaseResponse(['status' => 'failed', 'errorMessage' => 'error message', 'errorCode' => 'error code']);
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals('error message', $response->getMessage());
        $this->assertEquals('error code', $response->getCode());
    }
}