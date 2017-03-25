<?php
namespace PayConn\Model\NestPay;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Refund
 * @package PayConn\Model\NestPay
 */
class Refund extends AbstractModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $orderId;

    /**
     * @var float
     *
     * @Assert\NotBlank
     */
    protected $price;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $currency;

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}