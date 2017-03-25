<?php
namespace PayConn\Model\NestPay\AkBank;

use PayConn\Model\NestPay\AbstractPurchase;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Purchase
 * @package PayConn\Model\NestPay\AkBank
 */
class Purchase extends AbstractPurchase
{
    /**
     * @var string
     */
    const END_POINT_SANDBOX = 'https://entegrasyon.asseco-see.com.tr/fim/api';

    /**
     * @var string
     */
    const END_POINT_LIVE = 'https://www.sanalakpos.com/fim/api';

    /**
     * Get end point
     * @return string
     */
    public function getEndPoint()
    {
        if ($this->isTestMode()) {
            return self::END_POINT_SANDBOX;
        }
        return self::END_POINT_LIVE;
    }
}