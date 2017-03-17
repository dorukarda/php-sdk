<?php
namespace PayConn\Model;

/**
 * Interface BuyerInterface
 * @package PayConn\Model
 */
interface BuyerInterface
{
    public function setBuyer(Buyer $buyer);

    public function getBuyer();
}