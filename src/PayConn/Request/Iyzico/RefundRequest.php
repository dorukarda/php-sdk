<?php
namespace PayConn\Request\Iyzico;

use Iyzipay\Model\Locale;
use Iyzipay\Request\CreateRefundRequest;
use PayConn\Model\Iyzico\Refund;
use PayConn\Request\AbstractRequest;
use Iyzipay\Model\Refund as IyzicoRefund;
use PayConn\Response\Iyzico\RefundResponse;

/**
 * Class RefundRequest
 * @package PayConn\Request\Iyzico
 */
class RefundRequest extends AbstractRequest
{
    /**
     * RefundRequest constructor.
     * @param Refund $model
     */
    function __construct(Refund $model)
    {
        parent::__construct($model);
    }

    /**
     * Prepare
     * @return CreateRefundRequest
     */
    public function prepare()
    {
        /** @var Refund $model */
        $model = $this->getModel();

        // request
        $request = new CreateRefundRequest();
        $request->setLocale(Locale::TR);
        $request->setPrice($model->getPrice());
        $request->setIp($model->getIpAddress());
        $request->setPaymentTransactionId($model->getPaymentId());

        return $request;
    }

    /**
     * @return RefundResponse
     */
    public function send()
    {
        /** @var Refund $model */
        $model = $this->getModel();
        $postData = $this->prepare();

        // send
        $refund = $this->request($postData, $model);
        return new RefundResponse(json_decode($refund->getRawResult(), true));
    }

    /**
     * Request
     * @param CreateRefundRequest $postData
     * @param Refund $model
     * @return IyzicoRefund
     */
    protected function request(CreateRefundRequest $postData, Refund $model)
    {
        $responseModel = IyzicoRefund::create($postData, $model->getOptions());

        return $responseModel;
    }
}