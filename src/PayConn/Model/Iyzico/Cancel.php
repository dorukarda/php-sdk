<?php
namespace PayConn\Model\Iyzico;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Cancel
 * @package PayConn\Model\Iyzico
 */
class Cancel extends AbstractModel
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
}