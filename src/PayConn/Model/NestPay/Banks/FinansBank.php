<?php
namespace PayConn\Model\NestPay\Banks;

/**
 * Class FinansBank
 * @package PayConn\Model\NestPay\Banks
 */
class FinansBank extends AbstractBank
{
    /**
     * End points
     * @var array
     */
    protected $endPoints = [
        'test' => [
            'non_secure' => 'https://entegrasyon.asseco-see.com.tr/fim/api',
            '3d' => 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate'
        ],
        'prod' => [
            'non_secure' => 'https://www.fbwebpos.com/fim/api',
            '3d' => 'https://www.fbwebpos.com/fim/est3Dgate'
        ]
    ];
}