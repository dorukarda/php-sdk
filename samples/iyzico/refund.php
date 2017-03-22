<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PayConn\Model\Iyzico\Refund;
use PayConn\Request\Iyzico\RefundRequest;

// cancel
$apiKey = 'sandbox-aLgHT3OaxXOvrVc8pF24Z8PSIrKy6bJo';
$secretKey = 'sandbox-ohMKVD6DGjmPLiR6WTdaN5kkMy1Eh7Rq';
$refund = new Refund($apiKey, $secretKey);
$refund->setPaymentId('251542');
$refund->setIpAddress('127.0.0.1');
$refund->setPrice(2);
$refund->setTestMode(true);
$request = new RefundRequest($refund);
$response = $request->send();

// response
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();
