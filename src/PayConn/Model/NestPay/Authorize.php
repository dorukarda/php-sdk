<?php
namespace PayConn\Model\NestPay;

use PayConn\Model\CreditCard;
use PayConn\Model\CreditCardInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Authorize
 * @package PayConn\Model\NestPay
 */
class Authorize extends AbstractModel implements CreditCardInterface
{
    /**
     * 3d
     * @var string
     */
    const STORE_TYPE_3D = '3D';

    /**
     * 3d hosting
     * @var string
     */
    const STORE_TYPE_3D_HOSTING = '3DHosting';

    /**
     * 3d pay
     * @var string
     */
    const STORE_TYPE_3D_PAY = '3DPay';

    /**
     * @var CreditCard
     *
     * @Assert\Valid
     */
    protected $creditCard;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $successUrl;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $failureUrl;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $storeKey;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $storeType;

    /**
     * @return CreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCard $creditCard
     */
    public function setCreditCard($creditCard)
    {
        $this->creditCard = $creditCard;
    }

    /**
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @param string $successUrl
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
    }

    /**
     * @return string
     */
    public function getFailureUrl()
    {
        return $this->failureUrl;
    }

    /**
     * @param string $failureUrl
     */
    public function setFailureUrl($failureUrl)
    {
        $this->failureUrl = $failureUrl;
    }

    /**
     * @return string
     */
    public function getStoreKey()
    {
        return $this->storeKey;
    }

    /**
     * @param string $storeKey
     */
    public function setStoreKey($storeKey)
    {
        $this->storeKey = $storeKey;
    }

    /**
     * @return string
     */
    public function getStoreType()
    {
        return $this->storeType;
    }

    /**
     * @param string $storeType
     */
    public function setStoreType($storeType)
    {
        $this->storeType = $storeType;
    }

    /**
     * @Assert\IsTrue(message = "Credit card is required")
     *
     * @return bool
     */
    public function validateCreditCard()
    {
        if ($this->getStoreType() !== self::STORE_TYPE_3D_HOSTING && $this->getCreditCard() === null) {
            return false;
        }
        return true;
    }
}