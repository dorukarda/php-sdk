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
        $cancelRequest = $this->getMockBuilder(CancelRequest::class)
            ->setMethods(['getModel'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $cancelRequest->expects($this->any())->method('getModel')->willReturn($this->getDummyCancelModel());

        // request
        $createCancelRequest = $cancelRequest->prepare();
        $this->assertEquals('127.0.0.1', $createCancelRequest->getIp());
        $this->assertEquals(999, $createCancelRequest->getPaymentId());
    }

    /**
     * Test send
     */
    public function testSend()
    {
        $cancelRequest = $this->getMockBuilder(CancelRequest::class)
            ->setMethods(['getModel', 'request'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $cancelRequest->expects($this->any())->method('getModel')->willReturn($this->getDummyCancelModel());

        // mock request
        $cancel = new IyzicoCancel();
        $cancel->setRawResult(json_encode(['status' => 'success']));
        $cancelRequest->expects($this->any())->method('request')->willReturn($cancel);

        // send
        $response = $cancelRequest->send();
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Get dummy cancel model
     * @return Cancel
     */
    private function getDummyCancelModel()
    {
        $cancel = new Cancel('api key', 'secret key');
        $cancel->setIpAddress('127.0.0.1');
        $cancel->setPaymentId(999);

        return $cancel;
    }
}