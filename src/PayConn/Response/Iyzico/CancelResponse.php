<?php
namespace PayConn\Response\Iyzico;

use PayConn\Response\AbstractResponse;

/**
 * Class CancelResponse
 * @package PayConn\Response\Iyzico
 */
class CancelResponse extends AbstractResponse
{
    /**
     * is successful
     * @return bool
     */
    public function isSuccessful()
    {
        if ($this->offsetGet('status') === 'success') {
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
        return $this->offsetGet('errorMessage');
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
        return $this->offsetGet('errorCode');
    }
}