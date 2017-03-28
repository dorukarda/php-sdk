<?php
namespace PayConn\Request\NestPay\ThreeDModel\ThreeDPay;

use PayConn\PaymentException;
use PayConn\Request\NestPay\ThreeDModel\AbstractCompleteRequest;
use PayConn\Response\NestPay\ThreeDModel\ThreeDPay\CompleteResponse;

/**
 * Class CompleteRequest
 * @package PayConn\Request\NestPay\ThreeDModel\ThreeDPay
 */
class CompleteRequest extends AbstractCompleteRequest
{
    /**
     * Prepare
     * @return mixed
     * @throws PaymentException
     */
    public function prepare()
    {
        return $this->getModel()->getPostParams();
    }

    /**
     * Send
     * @return CompleteResponse
     */
    public function send()
    {
        $data = $this->prepare();
        return new CompleteResponse($data);
    }
}