<?php
namespace PayConn\Request\NestPay;

use PayConn\Model\NestPay\Cancel;
use PayConn\Request\AbstractRequest;
use GuzzleHttp\Client;
use PayConn\Response\NestPay\CancelResponse;

/**
 * Class CancelRequest
 * @package PayConn\Request\NestPay
 */
class CancelRequest extends AbstractRequest
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
    protected $xmlData = '<CC5Request><Name></Name><Password></Password><ClientId></ClientId><Mode></Mode><OrderId></OrderId><Type></Type><Currency></Currency></CC5Request>';

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
     * CancelRequest constructor.
     * @param Cancel $model
     */
    public function __construct(Cancel $model)
    {
        parent::__construct($model);
    }

    /**
     * Prepare
     * @return \SimpleXMLElement
     */
    public function prepare()
    {
        /** @var Cancel $model */
        $model = $this->getModel();
        $xml = @simplexml_load_string($this->getXmlData());
        $xml->Name = $model->getMerchantName();
        $xml->Password = $model->getMerchantPassword();
        $xml->ClientId = $model->getClientId();
        $xml->OrderId = $model->getOrderId();
        $xml->Type = Cancel::TYPE_VOID;
        $xml->Mode = self::MODE_LIVE;
        if ($model->isTestMode()) {
            $xml->Mode = self::MODE_TEST;
        }
        return $xml->saveXML();
    }

    /**
     * Send
     * @return CancelResponse
     */
    public function send()
    {
        $xml = $this->prepare();
        $response = $this->request($xml);
        return new CancelResponse($response);
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