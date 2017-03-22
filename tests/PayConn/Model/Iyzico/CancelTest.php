<?php
namespace PayConn\Tests\Model\Iyzico;

use PayConn\Model\Iyzico\Cancel;

/**
 * Class CancelTest
 * @package PayConn\Tests\Model\Iyzico
 */
class CancelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cancel
     */
    private $cancel;

    public function setUp()
    {
        $this->cancel = new Cancel('api key','secret key');
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->cancel->setPaymentId(123);
        $this->cancel->setIpAddress('127.0.0.1');
        $this->assertEquals(123,$this->cancel->getPaymentId());
        $this->assertEquals('127.0.0.1',$this->cancel->getIpAddress());
    }
}
