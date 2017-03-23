<?php
namespace PayConn\Tests\Response\Iyzico;

use PayConn\Response\Iyzico\QueryResponse;

/**
 * Class QueryResponseTest
 * @package PayConn\Tests\Response\Iyzico
 */
class QueryResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success response
     */
    public function testSuccessResponse()
    {
        $response = new QueryResponse(['status' => 'success']);
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Test failed response
     */
    public function testFailedResponse()
    {
        $response = new QueryResponse(['status' => 'failed', 'errorMessage' => 'error message', 'errorCode' => 'error code']);
        $this->assertEquals(false, $response->isSuccessful());
        $this->assertEquals('error message', $response->getMessage());
        $this->assertEquals('error code', $response->getCode());
    }
}