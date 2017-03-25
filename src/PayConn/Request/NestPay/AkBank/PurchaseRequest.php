<?php
namespace PayConn\Request\NestPay\AkBank;

use PayConn\Request\NestPay\AbstractPurchaseRequest;

/**
 * Class PurchaseRequest
 * @package PayConn\Request\NestPay\AkBank
 */
class PurchaseRequest extends AbstractPurchaseRequest
{
    public function prepare()
    {
        return parent::prepare();
    }

    public function send()
    {
        return parent::send();
    }
}