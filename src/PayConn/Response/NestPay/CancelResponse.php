<?php
namespace PayConn\Response\NestPay;

use PayConn\Response\AbstractResponse;

/**
 * Class CancelResponse
 * @package PayConn\Response\NestPay
 */
class CancelResponse extends AbstractResponse
{
    /**
     * is successful
     * @return bool
     */
    public function isSuccessful()
    {
        if ($this->offsetGet('Response') === 'Approved') {
            return true;
        }
        return false;
    }

    /**
     * Get message
     * @return null
     */
    public function getMessage()
    {
        if ($this->isSuccessful()) {
            return null;
        }
        return $this->offsetGet('ErrMsg');
    }

    /**
     * Get code
     * @return null
     */
    public function getCode()
    {
        if ($this->isSuccessful()) {
            return null;
        }
        return $this->offsetGet('ProcReturnCode');
    }
}