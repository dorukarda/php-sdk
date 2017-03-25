<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PayConn\Model\CreditCard;
use PayConn\Model\NestPay\AkBank\Purchase;
use PayConn\Request\NestPay\AkBank\PurchaseRequest;

// credit card
$creditCard = new CreditCard();
$creditCard->setHolderName('PayConn');
$creditCard->setNumber('4355084355084358');
$creditCard->setExpiryMonth('12');
$creditCard->setExpiryYear('2018');
$creditCard->setCvv('000');

// purchase
$purchase = new Purchase('100100000','AKTESTAPI','AKBANK01');
$purchase->setCreditCard($creditCard);
$purchase->setPrice(10);
$purchase->setInstallment(1);
$purchase->setType(Purchase::TYPE_AUTH);
$purchase->setTestMode(true);
$request = new PurchaseRequest($purchase);
$response = $request->send();
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();
echo "Reference ID : " . $response->getReferenceId();