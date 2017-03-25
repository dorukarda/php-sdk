<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PayConn\Model\NestPay\Cancel;
use PayConn\Request\NestPay\CancelRequest;
use PayConn\Model\NestPay\Banks\AkBank;

// cancel
$model = new Cancel(new AkBank(),'100100000','AKTESTAPI','AKBANK01');
$model->setOrderId('ORDER-17084VWBH19745');
$model->setTestMode(true);
$request = new CancelRequest($model);
$response = $request->send();
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();