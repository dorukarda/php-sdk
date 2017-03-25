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
     * @return CreateThreedsPaymentRequest
     */
    public function prepare()
    {
        /** @var Complete $model */
        $model = $this->getModel();

        // request
        $request = new CreateThreedsPaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setPaymentId($model->getPaymentId());

        return $request;
    }

    /**
     * @return CompleteResponse
     */
    public function send()
    {
        /** @var Complete $model */
        $model = $this->getModel();
        $postData = $this->prepare();

        // send
        $cancel = $this->request($postData, $model);
        return new CompleteResponse(json_decode($cancel->getRawResult(), true));
    }


    /**
     * Request
     * @param CreateThreedsPaymentRequest $postData
     * @param Complete $model
     * @return IyzicoThreedsPayment
     */
    protected function request(CreateThreedsPaymentRequest $postData, Complete $model)
    {
        $responseModel = IyzicoThreedsPayment::create($postData, $model->getOptions());

        return $responseModel;
    }
}