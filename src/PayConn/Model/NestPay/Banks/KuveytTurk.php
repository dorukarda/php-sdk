<?php
namespace PayConn\Model\NestPay\Banks;

/**
 * Class KuveytTurk
 * @package PayConn\Model\NestPay\Banks
 */
class KuveytTurk extends AbstractBank
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
            'non_secure' => 'https://netpos.kuveytturk.com.tr/servlet/cc5ApiServer',
            '3d' => 'https://netpos.kuveytturk.com.tr/servlet/est3Dgate'
        ]
    ];
}