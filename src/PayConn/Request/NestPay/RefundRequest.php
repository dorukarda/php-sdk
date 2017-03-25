<?php
namespace PayConn\Request\NestPay;

use PayConn\Model\NestPay\Refund;
use PayConn\Request\AbstractRequest;
use GuzzleHttp\Client;
use PayConn\Response\NestPay\RefundResponse;

/**
 * Class RefundRequest
 * @package PayConn\Request\NestPay
 */
class RefundRequest extends AbstractRequest
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
    protected $xmlData = '<CC5Request><Name></Name><Password></Password><ClientId></ClientId><Mode></Mode><OrderId></OrderId><Type></Type><Total></Total><Currency></Currency></CC5Request>';

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
        /** @var Refund $model */
        $model = $this->getModel();
        $xml = @simplexml_load_string($this->getXmlData());
        $xml->Name = $model->getMerchantName();
        $xml->Password = $model->getMerchantPassword();
        $xml->ClientId = $model->getClientId();
        $xml->OrderId = $model->getOrderId();
        $xml->Type = Refund::TYPE_CREDIT;
        $xml->Mode = self::MODE_LIVE;
        $xml->Total = $model->getPrice();
        $xml->Currency = $model->getCurrency();
        if ($model->isTestMode()) {
            $xml->Mode = self::MODE_TEST;
        }
        return $xml->saveXML();
    }

    /**
     * Send
     * @return RefundResponse
     */
    public function send()
    {
        $xml = $this->prepare();
        $response = $this->request($xml);
        return new RefundResponse($response);
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