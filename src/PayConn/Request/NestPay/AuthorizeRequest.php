<?php
namespace PayConn\Request\NestPay;

use PayConn\Model\NestPay\Authorize;
use PayConn\Request\AbstractRequest;
use PayConn\Response\NestPay\AuthorizeResponse;

/**
 * Class AuthorizeRequest
 * @package PayConn\Request\NestPay
 */
class AuthorizeRequest extends AbstractRequest
{
    /**
     * AuthorizeRequest constructor.
     * @param Authorize $model
     */
    public function __construct(Authorize $model)
    {
        parent::__construct($model);
    }

    /**
     * Get model
     * @return \PayConn\Model\NestPay\Authorize
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * Prepare
     * @return array
     */
    public function prepare()
    {
        $random = rand();
        $data = [
            'client_id' => $this->getModel()->getClientId(),
            'end_point' => $this->getModel()->getEndPoint('3d'),
            'price' => $this->getModel()->getPrice(),
            'success_url' => $this->getModel()->getSuccessUrl(),
            'failure_url' => $this->getModel()->getFailureUrl(),
            'type' => $this->getModel()->getType(),
            'installment' => $this->getModel()->getInstallment(),
            'store_type' => $this->getModel()->getStoreType(),
            'random' => $random,
            'hash' => $this->createHash('', $random),
            'order_id' => ''
        ];
        if ($this->getModel()->getStoreType() !== Authorize::STORE_TYPE_3D_HOSTING) {
            $data['credit_card'] = [
                'number' => $this->getModel()->getCreditCard()->getNumber(),
                'expiry_month' => $this->getModel()->getCreditCard()->getExpiryMonth(),
                'expiry_year' => $this->getModel()->getCreditCard()->getExpiryYear(),
                'cvv' => $this->getModel()->getCreditCard()->getCvv(),
                'holder_name' => $this->getModel()->getCreditCard()->getHolderName()
            ];
        }

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

    /**
     * Create hash
     * @param $orderId
     * @param $random
     * @return string
     */
    private function createHash($orderId, $random)
    {
        $hashData = $this->getModel()->getClientId() . $orderId . $this->getModel()->getPrice() . $this->getModel()->getSuccessUrl() . $this->getModel()->getFailureUrl() . $this->getModel()->getType() . $this->getModel()->getInstallment() . $random . $this->getModel()->getStoreKey();
        $hash = base64_encode(pack('H*', sha1($hashData)));

        return $hash;
    }
}