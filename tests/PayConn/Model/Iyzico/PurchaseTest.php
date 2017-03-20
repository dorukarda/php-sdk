<?php
namespace PayConn\Tests\Model\Iyzico;

use Iyzipay\Model\Currency;
use PayConn\Model\Buyer;
use PayConn\Model\CreditCard;
use PayConn\Model\Iyzico\BasketItem;
use PayConn\Model\Iyzico\Purchase;

/**
 * Class PurchaseTest
 * @package PayConn\Tests\Model\Iyzico
 */
class PurchaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Purchase
     */
    private $purchase;


    public function setUp()
    {
        $this->purchase = new Purchase('api key', 'secret key');
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->purchase->setPaidPrice(10);
        $this->purchase->setPrice(10);
        $this->purchase->setInstallment(9);

        // credit card
        $creditCard = new CreditCard();
        $creditCard->setHolderName('holder name');
        $this->purchase->setCreditCard($creditCard);

        // buyer
        $buyer = new Buyer();
        $buyer->setName('buyer name');
        $this->purchase->setBuyer($buyer);

        // basket item
        $basketItem = new BasketItem();
        $basketItem->setId(1);
        $basketItem->setName('product');
        $basketItem->setCategory('car');
        $basketItem->setPrice(10);
        $this->purchase->addBasketItem($basketItem);

        // gets
        $this->assertEquals('api key', $this->purchase->getApiKey());
        $this->assertEquals('secret key', $this->purchase->getSecretKey());
        $this->assertEquals(10, $this->purchase->getPaidPrice());
        $this->assertEquals(10, $this->purchase->getPrice());
        $this->assertEquals('holder name', $this->purchase->getCreditCard()->getHolderName());
        $this->assertEquals('buyer name', $this->purchase->getBuyer()->getName());
        $this->assertEquals(Currency::TL, $this->purchase->getCurrency());
        $this->assertEquals([$basketItem], $this->purchase->getBasketItems());
    }
}