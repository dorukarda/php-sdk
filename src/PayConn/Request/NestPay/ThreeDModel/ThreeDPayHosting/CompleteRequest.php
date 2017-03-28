<?php
namespace PayConn\Request\NestPay\ThreeDModel\ThreeDPayHosting;

use PayConn\PaymentException;
use PayConn\Request\NestPay\ThreeDModel\AbstractCompleteRequest;
use PayConn\Response\NestPay\ThreeDModel\ThreeDPayHosting\CompleteResponse;

/**
 * Class CompleteRequest
 * @package PayConn\Request\NestPay\ThreeDModel\ThreeDPayHosting
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