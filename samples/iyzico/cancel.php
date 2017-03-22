<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PayConn\Model\Iyzico\Cancel;
use PayConn\Request\Iyzico\CancelRequest;

// cancel
$apiKey = 'sandbox-aLgHT3OaxXOvrVc8pF24Z8PSIrKy6bJo';
$secretKey = 'sandbox-ohMKVD6DGjmPLiR6WTdaN5kkMy1Eh7Rq';
$cancel = new Cancel($apiKey, $secretKey);
$cancel->setPaymentId('251538');
$cancel->setIpAddress('127.0.0.1');
$cancel->setTestMode(true);
$request = new CancelRequest($cancel);
$response = $request->send();

// response
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();
