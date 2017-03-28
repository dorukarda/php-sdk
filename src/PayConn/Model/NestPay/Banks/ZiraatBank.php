<?php
namespace PayConn\Model\NestPay\Banks;

/**
 * Class ZiraatBank
 * @package PayConn\Model\NestPay\Banks
 */
class ZiraatBank extends AbstractBank
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
            'non_secure' => 'https://sanalpos2.ziraatbank.com.tr/fim/api',
            '3d' => 'https://sanalpos2.ziraatbank.com.tr/fim/est3dgate'
        ]
    ];
}