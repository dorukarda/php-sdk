<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PayConn\Model\Iyzico\Complete;
use PayConn\Request\Iyzico\CompleteRequest;

// cancel
$apiKey = 'sandbox-aLgHT3OaxXOvrVc8pF24Z8PSIrKy6bJo';
$secretKey = 'sandbox-ohMKVD6DGjmPLiR6WTdaN5kkMy1Eh7Rq';
$complete = new Complete($apiKey, $secretKey);
$complete->setPaymentId('251538');
$complete->setTestMode(true);
$request = new CompleteRequest($complete);
$response = $request->send();

// response
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();
echo "Reference ID : " . $response->getReferenceId();
