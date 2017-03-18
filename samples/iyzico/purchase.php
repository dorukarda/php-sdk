<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PayConn\Model\Iyzico\Purchase;
use PayConn\Model\CreditCard;
use PayConn\Model\Buyer;
use PayConn\Request\Iyzico\PurchaseRequest;

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

// purchase
$apiKey = 'sandbox-aLgHT3OaxXOvrVc8pF24Z8PSIrKy6bJo';
$secretKey = 'sandbox-ohMKVD6DGjmPLiR6WTdaN5kkMy1Eh7Rq';
$purchase = new Purchase($apiKey, $secretKey);
$purchase->setCreditCard($creditCard);
$purchase->setBuyer($buyer);
$purchase->setInstallment(1);
$purchase->setPaidPrice(10);
$purchase->setPrice(10);
$purchase->addBasketItem(9, 'Apple', 'Fruit', 10);
$purchase->setTestMode(true);

// request
$request = new PurchaseRequest();
$postData = $request->prepare($purchase);
$response = $request->send($postData);
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();
echo "Reference ID : " . $response->getReferenceId();