<?php
namespace PayConn\Model\NestPay;

use PayConn\Model\Buyer;
use PayConn\Model\BuyerInterface;
use PayConn\Model\CreditCard;
use PayConn\Model\CreditCardInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AbstractPurchase
 * @package PayConn\Model\NestPay
 */
abstract class AbstractPurchase extends AbstractModel implements CreditCardInterface, BuyerInterface
{
    /**
     * @var Buyer
     *
     * @Assert\Valid
     */
    protected $buyer;

    /**
     * @var CreditCard
     *
     * @Assert\NotBlank
     * @Assert\Valid
     */
    protected $creditCard;

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
    protected $currency = 949;

    /**
     * @return Buyer
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param Buyer $buyer
     */
    public function setBuyer(Buyer $buyer)
    {
        $this->buyer = $buyer;
    }

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