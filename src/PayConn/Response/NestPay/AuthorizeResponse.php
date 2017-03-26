<?php
namespace PayConn\Response\NestPay;

use PayConn\FormBuilder;
use PayConn\Response\AbstractResponse;

/**
 * Class AuthorizeResponse
 * @package PayConn\Response\NestPay
 */
class AuthorizeResponse extends AbstractResponse
{
    /**
     * is successful
     * @return bool
     */
    public function isSuccessful()
    {
        return true;
    }

    /**
     * Get message
     * @return null
     */
    public function getMessage()
    {
        return null;
    }

    /**
     * Get code
     * @return null
     */
    public function getCode()
    {
        return null;
    }

    /**
     * Get form
     * @return string
     */
    public function getForm()
    {
        $formBuilder = new FormBuilder();
        return $formBuilder->build('/nest-pay/'. $this->offsetGet('store_type').'.twig', $this->toArray());
    }
}