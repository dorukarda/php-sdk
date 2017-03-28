<?php
namespace PayConn\Request\NestPay\ThreeDModel\ThreeD;

use GuzzleHttp\Client;
use PayConn\PaymentException;
use PayConn\Request\NestPay\ThreeDModel\AbstractCompleteRequest;
use PayConn\Response\NestPay\ThreeDModel\ThreeD\CompleteResponse;

/**
 * Class CompleteRequest
 * @package PayConn\Request\NestPay\ThreeDModel\ThreeD
 */
class CompleteRequest extends AbstractCompleteRequest
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
        $xml->Mode = self::MODE_LIVE;
        $xml->Name = $this->getModel()->getMerchantName();
        $xml->Password = $this->getModel()->getMerchantPassword();
        $xml->ClientId = $this->getModel()->getClientId();
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
        $xml = $this->prepare();
        $response = $this->request($xml);
        return new CompleteResponse($response);
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
}