<?php
namespace PayConn\Tests\Request\Iyzico;

use PayConn\Model\Iyzico\Query;
use PayConn\Request\Iyzico\QueryRequest;
use Iyzipay\Model\Payment as IyzicoPayment;

/**
 * Class QueryRequestTest
 * @package PayConn\Tests\Request\Iyzico
 */
class QueryRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test prepare
     */
    public function testPrepare()
    {
        $request = $this->getMockBuilder(QueryRequest::class)
            ->setMethods(['getModel'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // request
        $createCancelRequest = $request->prepare();
        $this->assertEquals(999, $createCancelRequest->getPaymentId());
    }

    /**
     * Test send
     */
    public function testSend()
    {
        $request = $this->getMockBuilder(QueryRequest::class)
            ->setMethods(['getModel', 'request'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // mock request
        $payment = new IyzicoPayment();
        $payment->setRawResult(json_encode(['status' => 'success']));
        $request->expects($this->any())->method('request')->willReturn($payment);

        // send
        $response = $request->send();
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Get dummy model
     * @return Query
     */
    private function getDummyModel()
    {
        $model = new Query('api key', 'secret key');
        $model->setPaymentId(999);

        return $model;
    }
}