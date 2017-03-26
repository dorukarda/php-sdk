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
     * PurchaseRequest constructor.
     * @param Purchase $model
     */
    public function __construct(Purchase $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \PayConn\Model\NestPay\Purchase
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * Prepare
     * @return \SimpleXMLElement
     */
    public function prepare()
    {
        $xml = @simplexml_load_string($this->getXmlData());
        $xml->Name = $this->getModel()->getMerchantName();
        $xml->Password = $this->getModel()->getMerchantPassword();
        $xml->ClientId = $this->getModel()->getClientId();
        $xml->Type = $this->getModel()->getType();
        $xml->Number = $this->getModel()->getCreditCard()->getNumber();
        $xml->Expires = $this->getModel()->getCreditCard()->getExpiry('m/Y');
        $xml->Cvv2Val = $this->getModel()->getCreditCard()->getCvv();
        $xml->Total = $this->getModel()->getPrice();
        $xml->Currency = $this->getModel()->getCurrency();
        $xml->Taksit = $this->getModel()->getInstallment();
        $xml->Mode = self::MODE_LIVE;
        if ($this->getModel()->isTestMode()) {
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