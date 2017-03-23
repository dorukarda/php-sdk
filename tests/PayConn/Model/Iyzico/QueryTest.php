<?php
namespace PayConn\Tests\Model\Iyzico;

use PayConn\Model\Iyzico\Query;

/**
 * Class QueryTest
 * @package PayConn\Tests\Model\Iyzico
 */
class QueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Query
     */
    private $query;

    public function setUp()
    {
        $this->query = new Query('api key','secret key');
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->query->setPaymentId(123);
        $this->assertEquals(123,$this->query->getPaymentId());
    }
}
