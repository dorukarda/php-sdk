<?php
namespace PayConn\Tests\Request\Iyzico;

use Iyzipay\Model\Payment;
use PayConn\Model\Buyer;
use PayConn\Model\CreditCard;
use PayConn\Model\Iyzico\Purchase\BasketItem;
use PayConn\Model\Iyzico\Purchase;
use PayConn\Request\Iyzico\PurchaseRequest;

/**
 * Class PurchaseRequestTest
 * @package PayConn\Tests\Request\Iyzico
 */
class PurchaseRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test prepare
     */
    public function testPrepare()
    {
        $request = $this->getMockBuilder(PurchaseRequest::class)
            ->setMethods(['getModel'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // request
        $createPaymentRequest = $request->prepare();
        $this->assertEquals($createPaymentRequest->getPrice(), $this->getDummyModel()->getPrice());
        $this->assertEquals($createPaymentRequest->getBuyer()->getName(), $this->getDummyModel()->getBuyer()->getName());
        $this->assertEquals($createPaymentRequest->getPaymentCard()->getCardNumber(), $this->getDummyModel()->getCreditCard()->getNumber());
        $this->assertEquals($createPaymentRequest->getShippingAddress()->getZipCode(), $this->getDummyModel()->getBuyer()->getZipCode());
        $this->assertEquals($createPaymentRequest->getBasketItems()[0]->getName(), $this->getDummyModel()->getBasketItems()[0]->getName());
    }

    /**
     * Test send
     */
    public function testSend()
    {
        $request = $this->getMockBuilder(PurchaseRequest::class)
            ->setMethods(['getModel', 'request'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $request->expects($this->any())->method('getModel')->willReturn($this->getDummyModel());

        // mock request
        $payment = new Payment();
        $payment->setRawResult(json_encode(['status' => 'success', 'paymentId' => '123']));
        $request->expects($this->any())->method('request')->willReturn($payment);

        // send
        $response = $request->send();
        $this->assertEquals(true, $response->isSuccessful());
    }

    /**
     * Get dummy purchase model
     * @return Purchase
     */
    private function getDummyModel()
    {
        // credit card
        $creditCard = new CreditCard();
        $creditCard->setHolderName('PayConn');
        $creditCard->setNumber('5526080000000006');
        $creditCard->setExpiryMonth('01');
        $creditCard->setExpiryYear('2020');
        $creditCard->setCvv('123');

        // buyer
        $buyer = new Buyer();
        $buyer->setUniqueId('100');
        $buyer->setName('Murat');
        $buyer->setSurname('SAC');
        $buyer->setEmail('murat@payconn.com');
        $buyer->setAddress('Istanbul');
        $buyer->setCity('Istanbul');
        $buyer->setCountry('Turkey');
        $buyer->setIdentityNumber('123456789');
        $buyer->setIpNumber('127.0.0.1');
        $buyer->setPhone('1234567');
        $buyer->setZipCode('123456');

        // basket item
        $basketItem = new BasketItem();
        $basketItem->setId(1);
        $basketItem->setName('Apple');
        $basketItem->setCategory('Fruit');
        $basketItem->setPrice(10);

        // purchase
        $apiKey = 'sandbox-aLgHT3OaxXOvrVc8pF24Z8PSIrKy6bJo';
        $secretKey = 'sandbox-ohMKVD6DGjmPLiR6WTdaN5kkMy1Eh7Rq';
        $model = new Purchase($apiKey, $secretKey);
        $model->setCreditCard($creditCard);
        $model->setBuyer($buyer);
        $model->setInstallment(1);
        $model->setPaidPrice(10);
        $model->setPrice(10);
        $model->addBasketItem($basketItem);
        $model->setTestMode(true);

        return $model;
    }
}