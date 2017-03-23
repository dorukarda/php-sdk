<?php
namespace PayConn\Model\Iyzico;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Complete
 * @package PayConn\Model\Iyzico
 */
class Complete extends AbstractModel
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