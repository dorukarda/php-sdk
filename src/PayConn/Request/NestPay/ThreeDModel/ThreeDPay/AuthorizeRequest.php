<?php
namespace PayConn\Request\NestPay\ThreeDModel\ThreeDPay;

use PayConn\Request\NestPay\ThreeDModel\AbstractAuthorizeRequest;
use PayConn\Response\NestPay\AuthorizeResponse;

/**
 * Class AuthorizeRequest
 * @package PayConn\Request\NestPay\ThreeDModel\ThreeDPay
 */
class AuthorizeRequest extends AbstractAuthorizeRequest
{
    /**
     * Prepare
     * @return array
     */
    public function prepare()
    {
        $random = microtime();
        $data = [
            'order_id' => '',
            'client_id' => $this->getModel()->getClientId(),
            'end_point' => $this->getModel()->getEndPoint('3d'),
            'price' => $this->getModel()->getPrice(),
            'success_url' => $this->getModel()->getSuccessUrl(),
            'failure_url' => $this->getModel()->getFailureUrl(),
            'type' => $this->getModel()->getType(),
            'installment' => $this->getInstallment(),
            'store_type' => '3d_pay',
            'random' => $random,
            'hash' => $this->createHash('', $random),
            'currency' => $this->getModel()->getCurrency(),
            'credit_card' => [
                'number' => $this->getModel()->getCreditCard()->getNumber(),
                'expiry_month' => $this->getModel()->getCreditCard()->getExpiryMonth(),
                'expiry_year' => $this->getModel()->getCreditCard()->getExpiryYear(),
                'cvv' => $this->getModel()->getCreditCard()->getCvv(),
                'holder_name' => $this->getModel()->getCreditCard()->getHolderName()
            ]
        ];

        return $data;
    }

    /**
     * Send
     * @return AuthorizeResponse
     */
    public function send()
    {
        $postData = $this->prepare();

        return new AuthorizeResponse($postData);
    }
}