<?php
namespace PayConn\Tests\Request\Iyzico;

use PayConn\Model\Buyer;
use PayConn\Model\CreditCard;
use PayConn\Model\Iyzico\BasketItem;
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
        $prepareRequest = $this->getMockBuilder(PurchaseRequest::class)
            ->setMethods(['getModel'])
            ->disableOriginalConstructor()
            ->getMock();

        // mock getModel
        $prepareRequest->expects($this->any())->method('getModel')->willReturn($this->getDummyPurchaseModel());

        // request
        $createPaymentRequest = $prepareRequest->prepare();
        $this->assertEquals($createPaymentRequest->getPrice(), $this->getDummyPurchaseModel()->getPrice());
        $this->assertEquals($createPaymentRequest->getBuyer()->getName(), $this->getDummyPurchaseModel()->getBuyer()->getName());
        $this->assertEquals($createPaymentRequest->getPaymentCard()->getCardNumber(), $this->getDummyPurchaseModel()->getCreditCard()->getNumber());
        $this->assertEquals($createPaymentRequest->getShippingAddress()->getZipCode(), $this->getDummyPurchaseModel()->getBuyer()->getZipCode());
        $this->assertEquals($createPaymentRequest->getBasketItems()[0]->getName(), $this->getDummyPurchaseModel()->getBasketItems()[0]->getName());
    }

    /**
     * Get dummy purchase model
     * @return Purchase
     */
    private function getDummyPurchaseModel()
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
        $purchase = new Purchase($apiKey, $secretKey);
        $purchase->setCreditCard($creditCard);
        $purchase->setBuyer($buyer);
        $purchase->setInstallment(1);
        $purchase->setPaidPrice(10);
        $purchase->setPrice(10);
        $purchase->addBasketItem($basketItem);
        $purchase->setTestMode(true);

        return $purchase;
    }
}