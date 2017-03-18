<?php
namespace PayConn\Model\Iyzico;

use PayConn\Model\ModelInterface;

/**
 * Class AbstractModel
 * @package PayConn\Model\Iyzico
 */
abstract class AbstractModel implements ModelInterface
{
    /**
     * @var string
     */
    const END_POINT_SANDBOX = 'https://sandbox-api.iyzipay.com';

    /**
     * @var string
     */
    const END_POINT_LIVE = 'https://api.iyzipay.com';

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var bool
     */
    protected $testMode = false;

    /**
     * AbstractModel constructor.
     * @param $apiKey
     * @param $secretKey
     */
    public function __construct($apiKey, $secretKey)
    {
        $this->setApiKey($apiKey);
        $this->setSecretKey($secretKey);
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
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
     * Get end point
     * @return string
     */
    public function getEndPoint()
    {
        if ($this->isTestMode()) {
            return self::END_POINT_SANDBOX;
        }
        return self::END_POINT_LIVE;
    }
}