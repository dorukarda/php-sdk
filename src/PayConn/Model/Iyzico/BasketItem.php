<?php
namespace PayConn\Model\Iyzico;

use Iyzipay\Model\BasketItemType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BasketItem
 * @package PayConn\Model\Iyzico
 */
class BasketItem
{
    /**
     * @var integer
     *
     * @Assert\NotBlank
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var float
     *
     * @Assert\NotBlank
     */
    private $price;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    private $category;

    /**
     * @var string
     */
    private $type = BasketItemType::PHYSICAL;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}