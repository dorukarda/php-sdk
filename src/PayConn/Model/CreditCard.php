<?php
namespace PayConn\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreditCard
 * @package PayConn\Model
 */
class CreditCard
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    private $holderName;

    /**
     * @var integer
     *
     * @Assert\NotBlank
     */
    private $number;

    /**
     * @var integer
     *
     * @Assert\NotBlank
     */
    private $expiryMonth;

    /**
     * @var integer
     *
     * @Assert\NotBlank
     */
    private $expiryYear;

    /**
     * @var integer
     *
     * @Assert\NotBlank
     */
    private $cvv;

    /**
     * @return string
     */
    public function getHolderName()
    {
        return $this->holderName;
    }

    /**
     * @param string $holderName
     */
    public function setHolderName($holderName)
    {
        $this->holderName = $holderName;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * @param int $expiryMonth
     */
    public function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth;
    }

    /**
     * @return int
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * @param int $expiryYear
     */
    public function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear;
    }

    /**
     * @return int
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param int $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }
}