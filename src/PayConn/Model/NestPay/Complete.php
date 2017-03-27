<?php
namespace PayConn\Model\NestPay;

/**
 * Class Complete
 * @package PayConn\Model\NestPay
 */
class Complete extends AbstractModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $storeType;
}