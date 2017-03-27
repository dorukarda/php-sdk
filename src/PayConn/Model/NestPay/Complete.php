<?php
namespace PayConn\Model\NestPay;

use PayConn\ArrayIterator;
use Symfony\Component\Validator\Constraints as Assert;

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

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $storeKey;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $type;

    /**
     * @var ArrayIterator
     *
     * @Assert\NotBlank
     */
    protected $postParams;

    /**
     * @return string
     */
    public function getStoreKey()
    {
        return $this->storeKey;
    }

    /**
     * @param string $storeKey
     */
    public function setStoreKey($storeKey)
    {
        $this->storeKey = $storeKey;
    }

    /**
     * @return ArrayIterator
     */
    public function getPostParams()
    {
        return $this->postParams;
    }

    /**
     * @param array $postParams
     */
    public function setPostParams($postParams)
    {
        $this->postParams = new ArrayIterator($postParams);
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
     * @return string
     */
    public function getStoreType()
    {
        return $this->storeType;
    }

    /**
     * @param string $storeType
     */
    public function setStoreType($storeType)
    {
        $this->storeType = $storeType;
    }
}