<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PayConn\Model\CreditCard;
use PayConn\Model\NestPay\Authorize;
use PayConn\Request\NestPay\AuthorizeRequest;
use PayConn\Model\NestPay\Banks\AkBank;

// credit card
$creditCard = new CreditCard();
$creditCard->setHolderName('PayConn');
$creditCard->setNumber('4355084355084358');
$creditCard->setExpiryMonth('12');
$creditCard->setExpiryYear('2018');
$creditCard->setCvv('000');

// purchase
$model = new Authorize(new AkBank(),'100100000','AKTESTAPI','AKBANK01');
$model->setCreditCard($creditCard);
$model->setPrice(10);
$model->setInstallment(1);
$model->setType(Authorize::TYPE_AUTH);
$model->setStoreType(Authorize::STORE_TYPE_3D);
$model->setSuccessUrl('http://your-domain.com/success-url');
$model->setFailureUrl('http://your-domain.com/failure-url');
$model->setStoreKey('123456');
$model->setCurrency(AkBank::CURRENCY_TRY);
$model->setTestMode(true);
$request = new AuthorizeRequest($model);
$response = $request->send();
echo $response->getForm();
