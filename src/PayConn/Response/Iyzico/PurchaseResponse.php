<?php
namespace PayConn\Response\Iyzico;

use PayConn\Response\AbstractResponse;

/**
 * Class PurchaseResponse
 * @package PayConn\Response\Iyzico
 */
class PurchaseResponse extends AbstractResponse
{
    /**
     * is successful
     * @return bool
     */
    public function isSuccessful()
    {
        if ($this->getData()['status'] === 'success') {
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
        return $this->getData()['errorMessage'];
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
        return $this->getData()['errorCode'];
    }

    /**
     * Get response
     * @return array
     */
    public function getResponse()
    {
        return $this->getData();
    }

    /**
     * Get reference id
     * @return null
     */
    public function getReferenceId()
    {
        if (!$this->isSuccessful()) {
            return null;
        }
        return $this->getData()['paymentId'];
    }
}