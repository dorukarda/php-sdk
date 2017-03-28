<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PayConn\Model\NestPay\Query;
use PayConn\Request\NestPay\QueryRequest;
use PayConn\Model\NestPay\Banks\AkBank;

// cancel
$model = new Query(new AkBank(),'100100000','AKTESTAPI','AKBANK01');
$model->setOrderId('ORDER-17087W8dE11419');
$model->setTestMode(true);
$request = new QueryRequest($model);
$response = $request->send();
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();