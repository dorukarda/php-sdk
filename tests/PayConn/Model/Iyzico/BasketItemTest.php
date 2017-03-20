<?php
namespace PayConn\Tests\Request\Iyzico;

use Iyzipay\Model\BasketItemType;
use PayConn\Model\Iyzico\BasketItem;

/**
 * Class BasketItemTest
 * @package PayConn\Tests\Request\Iyzico
 */
class BasketItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BasketItem
     */
    private $basketItem;


    public function setUp()
    {
        $this->basketItem = new BasketItem();
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->basketItem->setId(1);
        $this->basketItem->setName('item');
        $this->basketItem->setCategory('item category');
        $this->basketItem->setPrice(10);
        $this->basketItem->setType(BasketItemType::PHYSICAL);
        $this->assertEquals(1, $this->basketItem->getId());
        $this->assertEquals('item', $this->basketItem->getName());
        $this->assertEquals('item category', $this->basketItem->getCategory());
        $this->assertEquals(10, $this->basketItem->getPrice());
        $this->assertEquals(BasketItemType::PHYSICAL, $this->basketItem->getType());
    }
}