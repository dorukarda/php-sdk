<?php
namespace PayConn\Model\Iyzico;

/**
 * Class AbstractModel
 * @package PayConn\Model\Iyzico
 */
abstract class AbstractModel
{
    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * AbstractModel constructor.
     * @param $baseUrl
     * @param $apiKey
     * @param $secretKey
     */
    public function __construct($baseUrl, $apiKey, $secretKey)
    {
        $this->setBaseUrl($baseUrl);
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
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

}