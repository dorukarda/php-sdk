<?php
namespace PayConn\Request\NestPay;

use PayConn\Model\NestPay\Purchase;
use PayConn\Request\AbstractRequest;
use GuzzleHttp\Client;
use PayConn\Response\NestPay\PurchaseResponse;

/**
 * Class AbstractPurchaseRequest
 * @package PayConn\Request\NestPay
 */
class PurchaseRequest extends AbstractRequest
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
    protected $xmlData = '<CC5Request><Name></Name><Password></Password><ClientId></ClientId><Type></Type><Total></Total><Taksit></Taksit><Currency></Currency><Number></Number><Expires></Expires><Cvv2Val></Cvv2Val></CC5Request>';

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
     * @return \SimpleXMLElement
     */
    public function prepare()
    {
        /** @var Purchase $model */
        $model = $this->getModel();
        $xml = @simplexml_load_string($this->getXmlData());
        $xml->Name = $model->getMerchantName();
        $xml->Password = $model->getMerchantPassword();
        $xml->ClientId = $model->getClientId();
        $xml->Type = $model->getType();
        $xml->Number = $model->getCreditCard()->getNumber();
        $xml->Expires = $model->getCreditCard()->getExpiry('m/Y');
        $xml->Cvv2Val = $model->getCreditCard()->getCvv();
        $xml->Total = $model->getPrice();
        $xml->Currency = $model->getCurrency();
        $xml->Taksit = $model->getInstallment();
        $xml->Mode = self::MODE_LIVE;
        if ($model->isTestMode()) {
            $xml->Mode = self::MODE_TEST;
        }
        return $xml->saveXML();
    }

    /**
     * Send
     * @return PurchaseResponse
     */
    public function send()
    {
        $xml = $this->prepare();
        $response = $this->request($xml);
        return new PurchaseResponse($response);
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