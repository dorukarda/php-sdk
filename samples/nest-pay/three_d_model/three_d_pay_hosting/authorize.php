<?php
require_once __DIR__ . '/../../../../vendor/autoload.php';

use PayConn\Model\NestPay\Authorize;
use PayConn\Request\NestPay\ThreeDModel\ThreeDPayHosting\AuthorizeRequest;
use PayConn\Model\NestPay\Banks\AkBank;

// purchase
$model = new Authorize(new AkBank(),'100300000','AKTESTAPI','AKBANK01');
$model->setPrice(10);
$model->setInstallment(1);
$model->setType(Authorize::TYPE_AUTH);
$model->setSuccessUrl('http://www.payconn.mil/samples/nest-pay/three_d_model/three_d_pay_hosting/complete.php');
$model->setFailureUrl('http://www.payconn.mil/samples/nest-pay/three_d_model/three_d_pay_hosting/complete.php');
$model->setStoreKey('123456');
$model->setCurrency(AkBank::CURRENCY_TRY);
$model->setTestMode(true);
$request = new AuthorizeRequest($model);
$response = $request->send();
echo $response->getForm();
