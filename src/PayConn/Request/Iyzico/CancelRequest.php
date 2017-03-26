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
     * @return \PayConn\Model\Iyzico\Cancel
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * Prepare
     * @return CreateCancelRequest
     */
    public function prepare()
    {
        // request
        $request = new CreateCancelRequest();
        $request->setLocale(Locale::TR);
        $request->setPaymentId($this->getModel()->getPaymentId());
        $request->setIp($this->getModel()->getIpAddress());

        return $request;
    }

    /**
     * @return CancelResponse
     */
    public function send()
    {
        $postData = $this->prepare();

        // send
        $cancel = $this->request($postData);
        return new CancelResponse(json_decode($cancel->getRawResult(), true));
    }

    /**
     * Request
     * @param CreateCancelRequest $postData
     * @return IyzicoCancel|Cancel
     */
    protected function request(CreateCancelRequest $postData)
    {
        $responseModel = IyzicoCancel::create($postData, $this->getModel()->getOptions());

        return $responseModel;
    }
}