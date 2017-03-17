<?php
namespace PayConn\Model;

/**
 * Interface CreditCardInterface
 * @package PayConn\Model
 */
interface CreditCardInterface
{
    public function setCreditCard(CreditCard $creditCard);

    public function getCreditCard();
}