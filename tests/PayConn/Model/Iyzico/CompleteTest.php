<?php
namespace PayConn\Tests\Model\Iyzico;

use PayConn\Model\Iyzico\Complete;

/**
 * Class CompleteTest
 * @package PayConn\Tests\Model\Iyzico
 */
class CompleteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Complete
     */
    private $complete;

    public function setUp()
    {
        $this->complete = new Complete('api key','secret key');
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->complete->setPaymentId(123);
        $this->assertEquals(123,$this->complete->getPaymentId());
    }
}
