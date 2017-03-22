<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PayConn\Model\Iyzico\Query;
use PayConn\Request\Iyzico\QueryRequest;

// cancel
$apiKey = 'sandbox-aLgHT3OaxXOvrVc8pF24Z8PSIrKy6bJo';
$secretKey = 'sandbox-ohMKVD6DGjmPLiR6WTdaN5kkMy1Eh7Rq';
$refund = new Query($apiKey, $secretKey);
$refund->setPaymentId('251542');
$refund->setTestMode(true);
$request = new QueryRequest($refund);
$response = $request->send();

// response
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();
