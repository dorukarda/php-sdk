<?php
namespace PayConn\Model\NestPay\Banks;

/**
 * Class AkBank
 * @package PayConn\Model\NestPay\Banks
 */
class AkBank extends AbstractBank
{
    /**
     * @var integer
     */
    const CURRENCY_TRY = 949;

    /**
     * @var integer
     */
    const CURRENCY_EURO = 978;

    /**
     * @var integer
     */
    const CURRENCY_USD = 840;

    /**
     * @var integer
     */
    const CURRENCY_GBP = 826;

    /**
     * @var integer
     */
    const CURRENCY_JPY = 392;

    /**
     * @var integer
     */
    const CURRENCY_RUB = 643;

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
            'non_secure' => 'https://www.sanalakpos.com/fim/api',
            '3d' => 'https://www.sanalakpos.com/fim/est3Dgate'
        ]
    ];
}