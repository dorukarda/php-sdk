<?php
namespace PayConn\Tests\Model;

use PayConn\Model\CreditCard;

/**
 * Class CreditCardTest
 * @package PayConn\Tests\Model
 */
class CreditCardTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var CreditCard
     */
    private $creditCard;

    public function setUp()
    {
        $this->creditCard = new CreditCard();
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->creditCard->setHolderName('PayConn');
        $this->creditCard->setNumber('4111111111111111');
        $this->creditCard->setExpiryMonth('01');
        $this->creditCard->setExpiryYear('2020');
        $this->creditCard->setCvv('123');
        $this->assertEquals('PayConn', $this->creditCard->getHolderName());
        $this->assertEquals('4111111111111111', $this->creditCard->getNumber());
        $this->assertEquals('01', $this->creditCard->getExpiryMonth());
        $this->assertEquals('2020', $this->creditCard->getExpiryYear());
        $this->assertEquals('123', $this->creditCard->getCvv());
    }
}