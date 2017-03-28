<?php
namespace PayConn\Request\NestPay\ThreeDModel;

use PayConn\Model\NestPay\Authorize;
use PayConn\Request\AbstractRequest;

/**
 * Class AbstractAuthorizeRequest
 * @package PayConn\Request\NestPay\ThreeDModel
 */
abstract class AbstractAuthorizeRequest extends AbstractRequest
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
     * Get installment
     * @return int|string
     */
    protected function getInstallment()
    {
        if ($this->getModel()->getInstallment() == 1) {
            return "";
        }
        return $this->getModel()->getInstallment();
    }

    /**
     * Create hash
     * @param $orderId
     * @param $random
     * @return string
     */
    protected function createHash($orderId, $random)
    {
        $hashData = $this->getModel()->getClientId() . $orderId . $this->getModel()->getPrice() . $this->getModel()->getSuccessUrl() . $this->getModel()->getFailureUrl() . $this->getModel()->getType() . $this->getInstallment() . $random . $this->getModel()->getStoreKey();
        $hash = base64_encode(pack('H*', sha1($hashData)));

        return $hash;
    }
}