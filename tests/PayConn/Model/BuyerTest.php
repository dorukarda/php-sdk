<?php
namespace PayConn\Tests\Model;

use PayConn\Model\Buyer;

/**
 * Class BuyerTest
 * @package PayConn\Tests\Model
 */
class BuyerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Buyer
     */
    private $buyer;

    public function setUp()
    {
        $this->buyer = new Buyer();
    }

    /**
     * Test set and get
     */
    public function testSetAndGet()
    {
        $this->buyer->setAddress('address');
        $this->buyer->setCity('city');
        $this->buyer->setCountry('country');
        $this->buyer->setEmail('email');
        $this->buyer->setIdentityNumber('identity number');
        $this->buyer->setIpNumber('ip number');
        $this->buyer->setName('name');
        $this->buyer->setPhone('phone');
        $this->buyer->setZipCode('zip code');
        $this->buyer->setSurname('surname');
        $this->assertEquals('address', $this->buyer->getAddress());
        $this->assertEquals('city', $this->buyer->getCity());
        $this->assertEquals('country', $this->buyer->getCountry());
        $this->assertEquals('email', $this->buyer->getEmail());
        $this->assertEquals('identity number', $this->buyer->getIdentityNumber());
        $this->assertEquals('ip number', $this->buyer->getIpNumber());
        $this->assertEquals('name', $this->buyer->getName());
        $this->assertEquals('phone', $this->buyer->getPhone());
        $this->assertEquals('zip code', $this->buyer->getZipCode());
        $this->assertEquals('surname', $this->buyer->getSurname());
    }
}