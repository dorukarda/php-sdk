<?php
namespace PayConn\Model\Iyzico;

use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Currency;
use Iyzipay\Model\PaymentChannel;
use Iyzipay\Model\PaymentGroup;
use PayConn\Model\Buyer;
use PayConn\Model\BuyerInterface;
use PayConn\Model\CreditCard;
use PayConn\Model\CreditCardInterface;

/**
 * Class Purchase
 * @package PayConn\Model\Iyzico
 */
class Purchase extends AbstractModel implements CreditCardInterface, BuyerInterface
{
    /**
     * @var CreditCard
     */
    protected $creditCard;

    /**
     * @var Buyer
     */
    protected $buyer;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $paidPrice;

    /**
     * @var integer
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
     * @var array
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
     * Add basket item
     * @param $name
     * @param $category
     * @param $price
     * @param string $type
     */
    public function addBasketItem($name, $category, $price, $type = BasketItemType::PHYSICAL)
    {
        $this->basketItems[] = ['name' => $name, 'category' => $category, 'price' => $price, 'type' => $type];
    }

    /**
     * Get basket items
     * @return array
     */
    public function getBasketItems()
    {
        return $this->basketItems;
    }
}