<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PayConn\Model\NestPay\Refund;
use PayConn\Request\NestPay\RefundRequest;
use PayConn\Model\NestPay\Banks\AkBank;

// cancel
$model = new Refund(new AkBank(),'100100000','AKTESTAPI','AKBANK01');
$model->setOrderId('ORDER-17084VwYH19783');
$model->setPrice(1);
$model->setCurrency(AkBank::CURRENCY_TRY);
$model->setTestMode(true);
$request = new RefundRequest($model);
$response = $request->send();
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();