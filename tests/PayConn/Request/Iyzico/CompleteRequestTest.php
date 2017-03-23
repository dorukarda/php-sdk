<?php
namespace PayConn\Tests\Request\Iyzico;

use PayConn\Model\Iyzico\Complete;
use PayConn\Request\Iyzico\CompleteRequest;
use Iyzipay\Model\ThreedsPayment as IyzicoThreedsPayment;

/**
 * Class CompleteRequestTest
 * @package PayConn\Tests\Request\Iyzico
 */
class CompleteRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test prepare
     */
    public function testPrepare()
    {
        $request = $this->getMockBuilder(CompleteRequest::class)
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
        $request = $this->getMockBuilder(CompleteRequest::class)
            ->setMethods(['getModel', 'request'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // mock request
        $cancel = new IyzicoThreedsPayment();
        $cancel->setRawResult(json_encode(['status' => 'success']));
        $request->expects($this->any())->method('request')->willReturn($cancel);

        // send
        $response = $request->send();
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Get dummy model
     * @return Complete
     */
    private function getDummyModel()
    {
        $model = new Complete('api key', 'secret key');
        $model->setPaymentId(999);

        return $model;
    }
}