<?php
namespace PayConn\Request\Iyzico;

use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Locale;
use Iyzipay\Model\Payment;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Request;
use Iyzipay\Request\CreatePaymentRequest;
use PayConn\Model\Iyzico\Purchase;
use PayConn\Request\AbstractRequest;
use PayConn\Response\Iyzico\PurchaseResponse;

/**
 * Class PurchaseRequest
 * @package PayConn\Request\Iyzico
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * PurchaseRequest constructor.
     * @param Purchase $model
     */
    public function __construct(Purchase $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \PayConn\Model\Iyzico\Purchase
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * Prepare
     * @return CreatePaymentRequest
     */
    public function prepare()
    {
        // request
        $request = new CreatePaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setPrice($this->getModel()->getPrice());
        $request->setPaidPrice($this->getModel()->getPaidPrice());
        $request->setCurrency($this->getModel()->getCurrency());
        $request->setInstallment($this->getModel()->getInstallment());
        $request->setPaymentChannel($this->getModel()->getPaymentChannel());
        $request->setPaymentGroup($this->getModel()->getPaymentGroup());

        // basket items
        $basketItems = [];
        foreach ($this->getModel()->getBasketItems() as $basketItemModel) {
            $basketItem = new BasketItem();
            $basketItem->setId($basketItemModel->getId());
            $basketItem->setName($basketItemModel->getName());
            $basketItem->setCategory1($basketItemModel->getCategory());
            $basketItem->setItemType($basketItemModel->getType());
            $basketItem->setPrice($basketItemModel->getPrice());
            $basketItems[] = $basketItem;
        }
        $request->setBasketItems($basketItems);

        // credit card
        $paymentCard = new PaymentCard();
        $paymentCard->setCardHolderName($this->getModel()->getCreditCard()->getHolderName());
        $paymentCard->setCardNumber($this->getModel()->getCreditCard()->getNumber());
        $paymentCard->setExpireMonth($this->getModel()->getCreditCard()->getExpiryMonth());
        $paymentCard->setExpireYear($this->getModel()->getCreditCard()->getExpiryYear());
        $paymentCard->setCvc($this->getModel()->getCreditCard()->getCvv());
        $paymentCard->setRegisterCard(0);
        $request->setPaymentCard($paymentCard);

        // buyer
        $buyer = new Buyer();
        $buyer->setId($this->getModel()->getBuyer()->getUniqueId());
        $buyer->setName($this->getModel()->getBuyer()->getName());
        $buyer->setSurname($this->getModel()->getBuyer()->getSurname());
        $buyer->setGsmNumber($this->getModel()->getBuyer()->getPhone());
        $buyer->setEmail($this->getModel()->getBuyer()->getEmail());
        $buyer->setIdentityNumber($this->getModel()->getBuyer()->getIdentityNumber());
        $buyer->setRegistrationAddress($this->getModel()->getBuyer()->getAddress());
        $buyer->setIp($this->getModel()->getBuyer()->getIpNumber());
        $buyer->setCity($this->getModel()->getBuyer()->getCity());
        $buyer->setCountry($this->getModel()->getBuyer()->getCountry());
        $buyer->setZipCode($this->getModel()->getBuyer()->getZipCode());
        $request->setBuyer($buyer);

        // shipping address
        $shippingAddress = new Address();
        $shippingAddress->setContactName($this->getModel()->getBuyer()->getName() . ' ' . $this->getModel()->getBuyer()->getSurname());
        $shippingAddress->setCity($this->getModel()->getBuyer()->getCity());
        $shippingAddress->setCountry($this->getModel()->getBuyer()->getCountry());
        $shippingAddress->setAddress($this->getModel()->getBuyer()->getAddress());
        $shippingAddress->setZipCode($this->getModel()->getBuyer()->getZipCode());
        $request->setShippingAddress($shippingAddress);

        // billing address
        $billingAddress = new Address();
        $billingAddress->setContactName($this->getModel()->getBuyer()->getName() . ' ' . $this->getModel()->getBuyer()->getSurname());
        $billingAddress->setCity($this->getModel()->getBuyer()->getCity());
        $billingAddress->setCountry($this->getModel()->getBuyer()->getCountry());
        $billingAddress->setAddress($this->getModel()->getBuyer()->getAddress());
        $billingAddress->setZipCode($this->getModel()->getBuyer()->getZipCode());
        $request->setBillingAddress($billingAddress);

        return $request;
    }

    /**
     * @return PurchaseResponse
     */
    public function send()
    {
        $postData = $this->prepare();

        // send
        $payment = $this->request($postData);
        return new PurchaseResponse(json_decode($payment->getRawResult(), true));
    }

    /**
     * Request
     * @param CreatePaymentRequest $postData
     * @return mixed
     */
    protected function request(CreatePaymentRequest $postData)
    {
        $responseModel = Payment::create($postData, $this->getModel()->getOptions());

        return $responseModel;
    }
}