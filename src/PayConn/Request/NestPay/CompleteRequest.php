<?php
namespace PayConn\Request\NestPay;

use GuzzleHttp\Client;
use PayConn\Model\NestPay\Authorize;
use PayConn\PaymentException;
use PayConn\Model\NestPay\Complete;
use PayConn\Request\AbstractRequest;
use PayConn\Response\NestPay\CompleteResponse;

/**
 * Class CompleteRequest
 * @package PayConn\Request\NestPay
 */
class CompleteRequest extends AbstractRequest
{
    /**
     * @var string
     */
    const MODE_TEST = 'T';

    /**
     * @var string
     */
    const MODE_LIVE = 'P';

    /**
     * @var string
     */
    protected $xmlData = '<?xml version="1.0" encoding="UTF-8"?><CC5Request><Name></Name><Password></Password><ClientId></ClientId><Mode></Mode><OrderId></OrderId><Type></Type><Number></Number><Total></Total><Currency></Currency><Taksit></Taksit><PayerTxnId></PayerTxnId><PayerSecurityLevel></PayerSecurityLevel><PayerAuthenticationCode></PayerAuthenticationCode><CardholderPresentCode>13</CardholderPresentCode></CC5Request>';

    /**
     * CompleteRequest constructor.
     * @param Complete $model
     */
    public function __construct(Complete $model)
    {
        parent::__construct($model);
    }

    /**
     * Get model
     * @return \PayConn\Model\NestPay\Complete
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * @return string
     */
    public function getXmlData()
    {
        return $this->xmlData;
    }

    /**
     * @param string $xmlData
     */
    public function setXmlData($xmlData)
    {
        $this->xmlData = $xmlData;
    }

    /**
     * Prepare
     * @return mixed
     * @throws PaymentException
     */
    public function prepare()
    {
        $this->checkHash();
        $xml = @simplexml_load_string($this->getXmlData());
        $xml->Name = $this->getModel()->getMerchantName();
        $xml->Password = $this->getModel()->getMerchantPassword();
        $xml->ClientId = $this->getModel()->getClientId();
        $xml->Mode = self::MODE_LIVE;
        $xml->OrderId = strval($this->getPostParam('oid'));
        $xml->Number = $this->getPostParam('md');
        $xml->Total = $this->getPostParam('amount');
        $xml->Currency = $this->getPostParam('currency');
        $xml->Taksit = $this->getPostParam('taksit');
        $xml->PayerTxnId = $this->getPostParam('xid');
        $xml->PayerSecurityLevel = $this->getPostParam('eci');
        $xml->PayerAuthenticationCode = $this->getPostParam('cavv');
        $xml->Type = $this->getModel()->getType();
        if ($this->getModel()->isTestMode()) {
            $xml->Mode = self::MODE_TEST;
        }
        return $xml->saveXML();
    }

    /**
     * Send
     * @return CompleteResponse
     */
    public function send()
    {
        if ($this->getModel()->getStoreType() !== Authorize::STORE_TYPE_3D) {
            return new CompleteResponse(['Response' => 'Approved', 'OrderId' => $this->getPostParam('oid')]);
        }
        $xml = $this->prepare();
        $response = $this->request($xml);
        return new CompleteResponse($response);
    }

    /**
     * Chech hash
     * @throws PaymentException
     */
    public function checkHash()
    {
        $start = 0;
        $hashParams = $this->getPostParam('HASHPARAMS');
        $paramsVal = "";
        while ($start < strlen($hashParams)) {
            $end = strpos($hashParams, ":", $start);
            $value = $this->getPostParam(substr($hashParams, $start, $end - $start));
            if ($value == null) {
                $value = "";
            }
            $paramsVal = $paramsVal . $value;
            $start = $end + 1;
        }
        $hash = base64_encode(pack('H*', sha1($paramsVal . $this->getModel()->getStoreKey())));
        if ($paramsVal != $this->getPostParam('HASHPARAMSVAL') || $this->getPostParam('HASH') != $hash) {
            throw new PaymentException('Security hash is invalid');
        }
    }

    /**
     * Request
     * @param $xml
     * @return mixed
     */
    protected function request($xml)
    {
        $client = new Client();
        // POST
        $response = $client->post($this->getModel()->getEndPoint(), ['body' => $xml]);
        return json_decode(json_encode(@simplexml_load_string($response->getBody()->getContents())), true);
    }

    /**
     * Get post param
     * @param $index
     * @return mixed|null
     */
    protected function getPostParam($index)
    {
        return $this->getModel()->getPostParams()->offsetGet($index);
    }
}