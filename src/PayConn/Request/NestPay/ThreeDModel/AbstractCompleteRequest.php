<?php
namespace PayConn\Request\NestPay\ThreeDModel;

use PayConn\Model\NestPay\Complete;
use PayConn\PaymentException;
use PayConn\Request\AbstractRequest;

/**
 * Class AbstractCompleteRequest
 * @package PayConn\Request\NestPay\ThreeDModel
 */
abstract class AbstractCompleteRequest extends AbstractRequest
{
    /**
     * CompleteRequest constructor.
     * @param Complete $model
     */
    public function __construct(Complete $model)
    {
        parent::__construct($model);
    }

    /**
     * Get model
     * @return \PayConn\Model\NestPay\Complete
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * Chech hash
     * @throws PaymentException
     */
    public function checkHash()
    {
        $start = 0;
        $hashParams = $this->getPostParam('HASHPARAMS');
        $paramsVal = "";
        while ($start < strlen($hashParams)) {
            $end = strpos($hashParams, ":", $start);
            $value = $this->getPostParam(substr($hashParams, $start, $end - $start));
            if ($value == null) {
                $value = "";
            }
            $paramsVal = $paramsVal . $value;
            $start = $end + 1;
        }
        $hash = base64_encode(pack('H*', sha1($paramsVal . $this->getModel()->getStoreKey())));
        if ($paramsVal != $this->getPostParam('HASHPARAMSVAL') || $this->getPostParam('HASH') != $hash) {
            throw new PaymentException('Security hash is invalid');
        }
    }

    /**
     * Get post param
     * @param $index
     * @return mixed|null
     */
    protected function getPostParam($index)
    {
        return $this->getModel()->getPostParams()->offsetGet($index);
    }
}