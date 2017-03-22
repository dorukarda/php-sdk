<?php
namespace PayConn\Tests\Model\Iyzico;

use PayConn\Model\Iyzico\Refund;

/**
 * Class RefundTest
 * @package PayConn\Tests\Model\Iyzico
 */
class RefundTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Refund
     */
    private $refund;

    public function setUp()
    {
        $this->refund = new Refund('api key','secret key');
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->refund->setPaymentId(123);
        $this->refund->setIpAddress('127.0.0.1');
        $this->refund->setPrice(9);
        $this->assertEquals(123,$this->refund->getPaymentId());
        $this->assertEquals('127.0.0.1',$this->refund->getIpAddress());
        $this->assertEquals(9,$this->refund->getPrice());
    }
}
