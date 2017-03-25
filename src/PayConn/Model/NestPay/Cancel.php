<?php
namespace PayConn\Model\NestPay;

use PayConn\Model\BuyerInterface;
use PayConn\Model\CreditCardInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AbstractCancel
 * @package PayConn\Model\NestPay
 */
abstract class AbstractCancel extends AbstractModel implements CreditCardInterface, BuyerInterface
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $orderId;

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
}