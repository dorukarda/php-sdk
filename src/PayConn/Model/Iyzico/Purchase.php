<?php
namespace PayConn\Model\Iyzico;

use Iyzipay\Model\Currency;
use Iyzipay\Model\PaymentChannel;
use Iyzipay\Model\PaymentGroup;
use PayConn\Model\Buyer;
use PayConn\Model\BuyerInterface;
use PayConn\Model\CreditCard;
use PayConn\Model\CreditCardInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Purchase
 * @package PayConn\Model\Iyzico
 */
class Purchase extends AbstractModel implements CreditCardInterface, BuyerInterface
{
    /**
     * @var CreditCard
     *
     * @Assert\NotBlank
     * @Assert\Valid
     */
    protected $creditCard;

    /**
     * @var Buyer
     *
     * @Assert\NotBlank
     * @Assert\Valid
     */
    protected $buyer;

    /**
     * @var float
     *
     * @Assert\NotBlank
     */
    protected $price;

    /**
     * @var float
     *
     * @Assert\NotBlank
     */
    protected $paidPrice;

    /**
     * @var integer
     *
     * @Assert\NotBlank
     */
    protected $installment;

    /**
     * @var string
     */
    protected $currency = Currency::TL;

    /**
     * @var string
     */
    protected $paymentChannel = PaymentChannel::WEB;

    /**
     * @var string
     */
    protected $paymentGroup = PaymentGroup::PRODUCT;

    /**
     * @var BasketItem[]
     *
     * @Assert\NotBlank
     * @Assert\Valid
     */
    protected $basketItems;

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
     * @return float
     */
    public function getPaidPrice()
    {
        return $this->paidPrice;
    }

    /**
     * @param float $paidPrice
     */
    public function setPaidPrice($paidPrice)
    {
        $this->paidPrice = $paidPrice;
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

    /**
     * @return string
     */
    public function getPaymentChannel()
    {
        return $this->paymentChannel;
    }

    /**
     * @param string $paymentChannel
     */
    public function setPaymentChannel($paymentChannel)
    {
        $this->paymentChannel = $paymentChannel;
    }

    /**
     * @return string
     */
    public function getPaymentGroup()
    {
        return $this->paymentGroup;
    }

    /**
     * @param string $paymentGroup
     */
    public function setPaymentGroup($paymentGroup)
    {
        $this->paymentGroup = $paymentGroup;
    }

    /**
     * Add BasketItem
     * @param BasketItem $basketItem
     */
    public function addBasketItem(BasketItem $basketItem)
    {
        $this->basketItems[] = $basketItem;
    }

    /**
     * Get basket items
     * @return BasketItem[]
     */
    public function getBasketItems()
    {
        return $this->basketItems;
    }
}