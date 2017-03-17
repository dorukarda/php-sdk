<?php
namespace PayConn\Model\Iyzico;

use PayConn\Model\CreditCard;
use PayConn\Model\CreditCardInterface;

/**
 * Class Purchase
 * @package PayConn\Model\Iyzico
 */
class Purchase extends AbstractModel implements CreditCardInterface
{
    /**
     * @var CreditCard
     */
    protected $creditCard;

    /**
     * @return CreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCard $creditCard
     */
    public function setCreditCard(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;
    }
}