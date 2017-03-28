<?php
namespace PayConn\Model\NestPay\Banks;

/**
 * Class HSBC
 * @package PayConn\Model\NestPay\Banks
 */
class HSBC extends AbstractBank
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
            'non_secure' => 'https://sanalpos.hsbc.com.tr/fim/api',
            '3d' => 'https://sanalpos.hsbc.com.tr/fim/est3Dgate'
        ]
    ];
}