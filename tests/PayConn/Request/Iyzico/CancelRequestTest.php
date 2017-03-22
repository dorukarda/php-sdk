<?php
namespace PayConn\Tests\Request\Iyzico;

use PayConn\Model\Iyzico\Cancel;
use PayConn\Request\Iyzico\CancelRequest;
use Iyzipay\Model\Cancel as IyzicoCancel;

/**
 * Class CancelRequestTest
 * @package PayConn\Tests\Request\Iyzico
 */
class CancelRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test prepare
     */
    public function testPrepare()
    {
        $request = $this->getMockBuilder(CancelRequest::class)
            ->setMethods(['getModel'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // request
        $createCancelRequest = $request->prepare();
        $this->assertEquals('127.0.0.1', $createCancelRequest->getIp());
        $this->assertEquals(999, $createCancelRequest->getPaymentId());
    }

    /**
     * Test send
     */
    public function testSend()
    {
        $request = $this->getMockBuilder(CancelRequest::class)
            ->setMethods(['getModel', 'request'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // mock request
        $cancel = new IyzicoCancel();
        $cancel->setRawResult(json_encode(['status' => 'success']));
        $request->expects($this->any())->method('request')->willReturn($cancel);

        // send
        $response = $request->send();
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Get dummy cancel model
     * @return Cancel
     */
    private function getDummyModel()
    {
        $model = new Cancel('api key', 'secret key');
        $model->setIpAddress('127.0.0.1');
        $model->setPaymentId(999);

        return $model;
    }
}