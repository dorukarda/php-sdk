<?php
namespace PayConn\Request\Iyzico;

use Iyzipay\Model\Locale;
use Iyzipay\Request\CreateCancelRequest;
use PayConn\Model\Iyzico\Cancel;
use PayConn\Request\AbstractRequest;
use Iyzipay\Model\Cancel as IyzicoCancel;
use PayConn\Response\Iyzico\CancelResponse;

/**
 * Class CancelRequest
 * @package PayConn\Request\Iyzico
 */
class CancelRequest extends AbstractRequest
{
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
     * @return CreateCancelRequest
     */
    public function prepare()
    {
        /** @var Cancel $model */
        $model = $this->getModel();

        // request
        $request = new CreateCancelRequest();
        $request->setLocale(Locale::TR);
        $request->setPaymentId($model->getPaymentId());
        $request->setIp($model->getIpAddress());

        return $request;
    }

    /**
     * @return CancelResponse
     */
    public function send()
    {
        /** @var Cancel $model */
        $model = $this->getModel();
        $postData = $this->prepare();

        // send
        $cancel = $this->request($postData, $model);
        return new CancelResponse(json_decode($cancel->getRawResult(), true));
    }

    /**
     * Request
     * @param CreateCancelRequest $postData
     * @param Cancel $model
     * @return IyzicoCancel|Cancel
     */
    protected function request(CreateCancelRequest $postData, Cancel $model)
    {
        $responseModel = IyzicoCancel::create($postData, $model->getOptions());

        return $responseModel;
    }
}