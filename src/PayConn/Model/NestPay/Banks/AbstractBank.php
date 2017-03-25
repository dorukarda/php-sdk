<?php
namespace PayConn\Model\NestPay\Banks;

/**
 * Class AbstractBank
 * @package PayConn\Model\NestPay\Banks
 */
abstract class AbstractBank implements BankInterface
{
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