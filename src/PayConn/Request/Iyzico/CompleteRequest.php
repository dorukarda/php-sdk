<?php
namespace PayConn\Request\Iyzico;

use Iyzipay\Model\Locale;
use Iyzipay\Request\CreateThreedsPaymentRequest;
use PayConn\Model\Iyzico\Complete;
use PayConn\Request\AbstractRequest;
use Iyzipay\Model\ThreedsPayment as IyzicoThreedsPayment;
use PayConn\Response\Iyzico\CompleteResponse;

/**
 * Class CompleteRequest
 * @package PayConn\Request\Iyzico
 */
class CompleteRequest extends AbstractRequest
{
    /**
     * CompleteRequest constructor.
     * @param Complete $model
     */
    public function __construct(Complete $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \PayConn\Model\Iyzico\Complete
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * @return CreateThreedsPaymentRequest
     */
    public function prepare()
    {
        // request
        $request = new CreateThreedsPaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setPaymentId($this->getModel()->getPaymentId());

        return $request;
    }

    /**
     * @return CompleteResponse
     */
    public function send()
    {
        $postData = $this->prepare();

        // send
        $cancel = $this->request($postData);
        return new CompleteResponse(json_decode($cancel->getRawResult(), true));
    }


    /**
     * Request
     * @param CreateThreedsPaymentRequest $postData
     * @return IyzicoThreedsPayment
     */
    protected function request(CreateThreedsPaymentRequest $postData)
    {
        $responseModel = IyzicoThreedsPayment::create($postData, $this->getModel()->getOptions());

        return $responseModel;
    }
}