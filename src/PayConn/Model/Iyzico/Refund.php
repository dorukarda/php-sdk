<?php
namespace PayConn\Model\Iyzico;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Refund
 * @package PayConn\Model\Iyzico
 */
class Refund extends AbstractModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    private $paymentId;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    private $ipAddress;

    /**
     * @var float
     *
     * @Assert\NotBlank
     */
    private $price;

    /**
     * @return string
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
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
}