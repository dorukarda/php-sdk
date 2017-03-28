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
     * @var float
     *
     * @Assert\NotBlank
     */
    protected $price;

    /**
     * @var integer
     *
     * @Assert\NotBlank
     */
    protected $installment;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $type;

    /**
     * @var integer
     *
     * @Assert\NotBlank
     */
    protected $currency;

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
    public function setCreditCard(CreditCard $creditCard)
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
     * @return int
     */
    public function getInstallment()
    {
        return $this->installment;
    }

    /**
     * @param int $installment
     */
    public function setInstallment($installment)
    {
        $this->installment = $installment;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param int $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}