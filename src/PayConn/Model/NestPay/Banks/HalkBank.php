<?php
namespace PayConn\Model\NestPay\Banks;

/**
 * Class HalkBank
 * @package PayConn\Model\NestPay\Banks
 */
class HalkBank extends AbstractBank
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
            'non_secure' => 'https://sanalpos.halkbank.com.tr/fim/api',
            '3d' => 'https://sanalpos.halkbank.com.tr/fim/est3Dgate'
        ]
    ];
}