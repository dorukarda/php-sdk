<?php
namespace PayConn\Model\NestPay;

use PayConn\Model\ModelInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AbstractModel
 * @package PayConn\Model\NestPay
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * @var string
     */
    const TYPE_AUTH = 'Auth';

    /**
     * @var string
     */
    const TYPE_PRE_AUTH = 'PreAuth';

    /**
     * @var string
     */
    const TYPE_POST_AUTH = 'PostAuth';

    /**
     * @var string
     */
    const TYPE_VOID = 'Void';

    /**
     * @var string
     */
    const TYPE_CREDIT = 'Credit';

    /**
     * @var bool
     */
    protected $testMode = false;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $merchantName;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $merchantPassword;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $clientId;

    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $type;

    /**
     * AbstractModel constructor.
     * @param $merchantName
     * @param $merchantPassword
     * @param $clientId
     */
    public function __construct($clientId, $merchantName, $merchantPassword)
    {
        $this->setMerchantName($merchantName);
        $this->setMerchantPassword($merchantPassword);
        $this->setClientId($clientId);
    }

    /**
     * @return boolean
     */
    public function isTestMode()
    {
        return $this->testMode;
    }

    /**
     * @param boolean $testMode
     */
    public function setTestMode($testMode)
    {
        $this->testMode = $testMode;
    }

    /**
     * @return string
     */
    public function getMerchantName()
    {
        return $this->merchantName;
    }

    /**
     * @param string $merchantName
     */
    public function setMerchantName($merchantName)
    {
        $this->merchantName = $merchantName;
    }

    /**
     * @return string
     */
    public function getMerchantPassword()
    {
        return $this->merchantPassword;
    }

    /**
     * @param string $merchantPassword
     */
    public function setMerchantPassword($merchantPassword)
    {
        $this->merchantPassword = $merchantPassword;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
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
}

