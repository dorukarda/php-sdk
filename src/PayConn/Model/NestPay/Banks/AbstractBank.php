<?php
namespace PayConn\Model\NestPay\Banks;

/**
 * Class AbstractBank
 * @package PayConn\Model\NestPay\Banks
 */
abstract class AbstractBank implements BankInterface
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
     * @var array
     */
    protected $endPoints;

    /**
     * Get end points
     * @return array
     */
    public function getEndPoints()
    {
        return $this->endPoints;
    }
}