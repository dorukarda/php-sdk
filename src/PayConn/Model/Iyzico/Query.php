<?php
namespace PayConn\Model\Iyzico;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Query
 * @package PayConn\Model\Iyzico
 */
class Query extends AbstractModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    private $paymentId;

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
}