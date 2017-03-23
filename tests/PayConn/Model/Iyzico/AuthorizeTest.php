<?php
namespace PayConn\Tests\Model\Iyzico;

use Iyzipay\Model\Currency;
use PayConn\Model\Buyer;
use PayConn\Model\CreditCard;
use PayConn\Model\Iyzico\Authorize;
use PayConn\Model\Iyzico\Purchase\BasketItem;

/**
 * Class AuthorizeTest
 * @package PayConn\Tests\Model\Iyzico
 */
class AuthorizeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Authorize
     */
    private $authorize;


    public function setUp()
    {
        $this->authorize = new Authorize('api key', 'secret key');
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->authorize->setPaidPrice(10);
        $this->authorize->setPrice(10);
        $this->authorize->setInstallment(9);
        $this->authorize->setCallbackUrl('http://your-domain.com');

        // credit card
        $creditCard = new CreditCard();
        $creditCard->setHolderName('holder name');
        $this->authorize->setCreditCard($creditCard);

        // buyer
        $buyer = new Buyer();
        $buyer->setName('buyer name');
        $this->authorize->setBuyer($buyer);

        // basket item
        $basketItem = new BasketItem();
        $basketItem->setId(1);
        $basketItem->setName('product');
        $basketItem->setCategory('car');
        $basketItem->setPrice(10);
        $this->authorize->addBasketItem($basketItem);

        // gets
        $this->assertEquals('api key', $this->authorize->getApiKey());
        $this->assertEquals('secret key', $this->authorize->getSecretKey());
        $this->assertEquals(10, $this->authorize->getPaidPrice());
        $this->assertEquals(10, $this->authorize->getPrice());
        $this->assertEquals('holder name', $this->authorize->getCreditCard()->getHolderName());
        $this->assertEquals('buyer name', $this->authorize->getBuyer()->getName());
        $this->assertEquals(Currency::TL, $this->authorize->getCurrency());
        $this->assertEquals([$basketItem], $this->authorize->getBasketItems());
        $this->assertEquals('http://your-domain.com', $this->authorize->getCallbackUrl());
    }
}