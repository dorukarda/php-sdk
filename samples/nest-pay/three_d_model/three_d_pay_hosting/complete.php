<?php
require_once __DIR__ . '/../../../../vendor/autoload.php';

use PayConn\Model\NestPay\Authorize;
use PayConn\Model\NestPay\Complete;
use PayConn\Request\NestPay\ThreeDModel\ThreeDPayHosting\CompleteRequest;
use PayConn\Model\NestPay\Banks\AkBank;

// cancel
$model = new Complete(new AkBank(),'100300000','AKTESTAPI','AKBANK01');
$model->setPostParams($_POST);
$model->setStoreKey('123456');
$model->setType(Authorize::TYPE_AUTH);
$model->setTestMode(true);
$request = new CompleteRequest($model);
$response = $request->send();
echo "Is Successful : " . $response->isSuccessful();
echo "Message : " . $response->getMessage();
echo "Code : " . $response->getCode();
echo "Reference Id : " . $response->getReferenceId();