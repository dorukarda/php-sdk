<?php
namespace PayConn\Request\Iyzico;

use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Model\ThreedsInitialize;
use Iyzipay\Request;
use Iyzipay\Request\CreatePaymentRequest;
use PayConn\Model\Iyzico\Authorize;
use PayConn\Request\AbstractRequest;
use PayConn\Response\Iyzico\AuthorizeResponse;

/**
 * Class AuthorizeRequest
 * @package PayConn\Request\Iyzico
 */
class AuthorizeRequest extends AbstractRequest
{
    /**
     * Prepare
     * @return CreatePaymentRequest
     */
    public function prepare()
    {
        /** @var Authorize $model */
        $model = $this->getModel();

        // request
        $request = new CreatePaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setPrice($model->getPrice());
        $request->setPaidPrice($model->getPaidPrice());
        $request->setCurrency($model->getCurrency());
        $request->setInstallment($model->getInstallment());
        $request->setPaymentChannel($model->getPaymentChannel());
        $request->setPaymentGroup($model->getPaymentGroup());
        $request->setCallbackUrl($model->getCallbackUrl());

        // basket items
        $basketItems = [];
        foreach ($model->getBasketItems() as $basketItemModel) {
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
        $paymentCard->setCardHolderName($model->getCreditCard()->getHolderName());
        $paymentCard->setCardNumber($model->getCreditCard()->getNumber());
        $paymentCard->setExpireMonth($model->getCreditCard()->getExpiryMonth());
        $paymentCard->setExpireYear($model->getCreditCard()->getExpiryYear());
        $paymentCard->setCvc($model->getCreditCard()->getCvv());
        $paymentCard->setRegisterCard(0);
        $request->setPaymentCard($paymentCard);

        // buyer
        $buyer = new Buyer();
        $buyer->setId($model->getBuyer()->getUniqueId());
        $buyer->setName($model->getBuyer()->getName());
        $buyer->setSurname($model->getBuyer()->getSurname());
        $buyer->setGsmNumber($model->getBuyer()->getPhone());
        $buyer->setEmail($model->getBuyer()->getEmail());
        $buyer->setIdentityNumber($model->getBuyer()->getIdentityNumber());
        $buyer->setRegistrationAddress($model->getBuyer()->getAddress());
        $buyer->setIp($model->getBuyer()->getIpNumber());
        $buyer->setCity($model->getBuyer()->getCity());
        $buyer->setCountry($model->getBuyer()->getCountry());
        $buyer->setZipCode($model->getBuyer()->getZipCode());
        $request->setBuyer($buyer);

        // shipping address
        $shippingAddress = new Address();
        $shippingAddress->setContactName($model->getBuyer()->getName() . ' ' . $model->getBuyer()->getSurname());
        $shippingAddress->setCity($model->getBuyer()->getCity());
        $shippingAddress->setCountry($model->getBuyer()->getCountry());
        $shippingAddress->setAddress($model->getBuyer()->getAddress());
        $shippingAddress->setZipCode($model->getBuyer()->getZipCode());
        $request->setShippingAddress($shippingAddress);

        // billing address
        $billingAddress = new Address();
        $billingAddress->setContactName($model->getBuyer()->getName() . ' ' . $model->getBuyer()->getSurname());
        $billingAddress->setCity($model->getBuyer()->getCity());
        $billingAddress->setCountry($model->getBuyer()->getCountry());
        $billingAddress->setAddress($model->getBuyer()->getAddress());
        $billingAddress->setZipCode($model->getBuyer()->getZipCode());
        $request->setBillingAddress($billingAddress);

        return $request;
    }

    /**
     * @return AuthorizeResponse
     */
    public function send()
    {
        /** @var Authorize $model */
        $model = $this->getModel();
        $postData = $this->prepare();

        // send
        $payment = $this->request($postData, $model);
        return new AuthorizeResponse(json_decode($payment->getRawResult(), true));
    }


    /**
     * Request
     * @param CreatePaymentRequest $postData
     * @param Authorize $model
     * @return ThreedsInitialize
     */
    protected function request(CreatePaymentRequest $postData, Authorize $model)
    {
        $responseModel = ThreedsInitialize::create($postData, $model->getOptions());

        return $responseModel;
    }
}