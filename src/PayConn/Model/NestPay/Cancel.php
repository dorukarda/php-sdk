<?php
namespace PayConn\Model\NestPay;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AbstractCancel
 * @package PayConn\Model\NestPay
 */
class Cancel extends AbstractModel
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