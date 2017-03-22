<?php
namespace PayConn\Tests\Request\Iyzico;

use PayConn\Model\Iyzico\Refund;
use PayConn\Request\Iyzico\RefundRequest;
use Iyzipay\Model\Refund as IyzicoRefund;

/**
 * Class RefundRequestTest
 * @package PayConn\Tests\Request\Iyzico
 */
class RefundRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test prepare
     */
    public function testPrepare()
    {
        $request = $this->getMockBuilder(RefundRequest::class)
            ->setMethods(['getModel'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // request
        $createRequest = $request->prepare();
        $this->assertEquals('127.0.0.1', $createRequest->getIp());
        $this->assertEquals(999, $createRequest->getPaymentTransactionId());
        $this->assertEquals(9, $createRequest->getPrice());
    }

    /**
     * Test send
     */
    public function testSend()
    {
        $request = $this->getMockBuilder(RefundRequest::class)
            ->setMethods(['getModel', 'request'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // mock request
        $cancel = new IyzicoRefund();
        $cancel->setRawResult(json_encode(['status' => 'success']));
        $request->expects($this->any())->method('request')->willReturn($cancel);

        // send
        $response = $request->send();
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Get dummy model
     * @return Refund
     */
    private function getDummyModel()
    {
        $model = new Refund('api key', 'secret key');
        $model->setIpAddress('127.0.0.1');
        $model->setPaymentId(999);
        $model->setPrice(9);

        return $model;
    }
}