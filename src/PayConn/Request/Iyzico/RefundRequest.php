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
     * @return \PayConn\Model\Iyzico\Refund
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * Prepare
     * @return CreateRefundRequest
     */
    public function prepare()
    {
        // request
        $request = new CreateRefundRequest();
        $request->setLocale(Locale::TR);
        $request->setPrice($this->getModel()->getPrice());
        $request->setIp($this->getModel()->getIpAddress());
        $request->setPaymentTransactionId($this->getModel()->getPaymentId());

        return $request;
    }

    /**
     * @return RefundResponse
     */
    public function send()
    {
        $postData = $this->prepare();

        // send
        $refund = $this->request($postData);
        return new RefundResponse(json_decode($refund->getRawResult(), true));
    }

    /**
     * Request
     * @param CreateRefundRequest $postData
     * @return IyzicoRefund
     */
    protected function request(CreateRefundRequest $postData)
    {
        $responseModel = IyzicoRefund::create($postData, $this->getModel()->getOptions());

        return $responseModel;
    }
}