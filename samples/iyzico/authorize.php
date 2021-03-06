<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PayConn\Model\Iyzico\Authorize;
use PayConn\Model\CreditCard;
use PayConn\Model\Buyer;
use PayConn\Request\Iyzico\AuthorizeRequest;
use PayConn\Model\Iyzico\Purchase\BasketItem;

// credit card
$creditCard = new CreditCard();
$creditCard->setHolderName('PayConn');
$creditCard->setNumber('5526080000000006');
$creditCard->setExpiryMonth('01');
$creditCard->setExpiryYear('2020');
$creditCard->setCvv('123');

// buyer
$buyer = new Buyer();
$buyer->setUniqueId('100');
$buyer->setName('Murat');
$buyer->setSurname('SAC');
$buyer->setEmail('murat@payconn.com');
$buyer->setAddress('Istanbul');
$buyer->setCity('Istanbul');
$buyer->setCountry('Turkey');
$buyer->setIdentityNumber('123456789');
$buyer->setIpNumber('127.0.0.1');
$buyer->setPhone('1234567');
$buyer->setZipCode('123456');

// basket item
$basketItem = new BasketItem();
$basketItem->setId(1);
$basketItem->setName('Apple');
$basketItem->setCategory('Fruit');
$basketItem->setPrice(10);

// purchase
$apiKey = 'sandbox-aLgHT3OaxXOvrVc8pF24Z8PSIrKy6bJo';
$secretKey = 'sandbox-ohMKVD6DGjmPLiR6WTdaN5kkMy1Eh7Rq';
$authorize = new Authorize($apiKey, $secretKey);
$authorize->setCreditCard($creditCard);
$authorize->setBuyer($buyer);
$authorize->setInstallment(1);
$authorize->setPaidPrice(10);
$authorize->setPrice(10);
$authorize->addBasketItem($basketItem);
$authorize->setCallbackUrl('http://www.payconn.com/iyzico/callback.php');
$authorize->setTestMode(true);

// request
$request = new AuthorizeRequest($authorize);
$response = $request->send();
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();
echo "HTML Content : " . $response->getHtmlContent();