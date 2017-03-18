<?php
namespace PayConn\Request\Iyzico;

use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Locale;
use Iyzipay\Model\Payment;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Options;
use Iyzipay\Request\CreatePaymentRequest;
use PayConn\Model\Iyzico\Purchase;
use PayConn\Model\ModelInterface;
use PayConn\Request\AbstractRequest;
use PayConn\Response\Iyzico\PurchaseResponse;

/**
 * Class PurchaseRequest
 * @package PayConn\Request\Iyzico
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @param ModelInterface $model
     * @return Purchase
     */
    public function prepare(ModelInterface $model)
    {
        return $model;
    }

    /**
     * Send
     * @param Purchase $postData
     * @return PurchaseResponse
     */
    public function send($postData)
    {
        // options
        $options = new Options();
        $options->setBaseUrl($postData->getEndPoint());
        $options->setApiKey($postData->getApiKey());
        $options->setSecretKey($postData->getSecretKey());

        // request
        $request = new CreatePaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setPrice($postData->getPrice());
        $request->setPaidPrice($postData->getPaidPrice());
        $request->setCurrency($postData->getCurrency());
        $request->setInstallment($postData->getInstallment());
        $request->setPaymentChannel($postData->getPaymentChannel());
        $request->setPaymentGroup($postData->getPaymentGroup());

        // basket items
        $basketItems = [];
        foreach ($postData->getBasketItems() as $basketItemData) {
            $basketItem = new BasketItem();
            $basketItem->setId($basketItemData['id']);
            $basketItem->setName($basketItemData['name']);
            $basketItem->setCategory1($basketItemData['category']);
            $basketItem->setItemType($basketItemData['type']);
            $basketItem->setPrice($basketItemData['price']);
            $basketItems[] = $basketItem;
        }
        $request->setBasketItems($basketItems);

        // credit card
        $paymentCard = new PaymentCard();
        $paymentCard->setCardHolderName($postData->getCreditCard()->getHolderName());
        $paymentCard->setCardNumber($postData->getCreditCard()->getNumber());
        $paymentCard->setExpireMonth($postData->getCreditCard()->getExpiryMonth());
        $paymentCard->setExpireYear($postData->getCreditCard()->getExpiryYear());
        $paymentCard->setCvc($postData->getCreditCard()->getCvv());
        $paymentCard->setRegisterCard(0);
        $request->setPaymentCard($paymentCard);

        // buyer
        $buyer = new Buyer();
        $buyer->setId($postData->getBuyer()->getUniqueId());
        $buyer->setName($postData->getBuyer()->getName());
        $buyer->setSurname($postData->getBuyer()->getSurname());
        $buyer->setGsmNumber($postData->getBuyer()->getPhone());
        $buyer->setEmail($postData->getBuyer()->getEmail());
        $buyer->setIdentityNumber($postData->getBuyer()->getIdentityNumber());
        $buyer->setRegistrationAddress($postData->getBuyer()->getAddress());
        $buyer->setIp($postData->getBuyer()->getIpNumber());
        $buyer->setCity($postData->getBuyer()->getCity());
        $buyer->setCountry($postData->getBuyer()->getCountry());
        $buyer->setZipCode($postData->getBuyer()->getZipCode());
        $request->setBuyer($buyer);

        // shipping address
        $shippingAddress = new Address();
        $shippingAddress->setContactName($postData->getBuyer()->getName() . ' ' . $postData->getBuyer()->getSurname());
        $shippingAddress->setCity($postData->getBuyer()->getCity());
        $shippingAddress->setCountry($postData->getBuyer()->getCountry());
        $shippingAddress->setAddress($postData->getBuyer()->getAddress());
        $shippingAddress->setZipCode($postData->getBuyer()->getZipCode());
        $request->setShippingAddress($shippingAddress);

        // billing address
        $billingAddress = new Address();
        $billingAddress->setContactName($postData->getBuyer()->getName() . ' ' . $postData->getBuyer()->getSurname());
        $billingAddress->setCity($postData->getBuyer()->getCity());
        $billingAddress->setCountry($postData->getBuyer()->getCountry());
        $billingAddress->setAddress($postData->getBuyer()->getAddress());
        $billingAddress->setZipCode($postData->getBuyer()->getZipCode());
        $request->setBillingAddress($billingAddress);

        // send
        $payment = Payment::create($request, $options);
        return new PurchaseResponse(json_decode($payment->getRawResult(), true));
    }
}