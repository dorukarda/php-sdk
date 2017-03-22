<?php
namespace PayConn\Request\Iyzico;

use Iyzipay\Model\Locale;
use Iyzipay\Request\RetrievePaymentRequest;
use PayConn\Model\Iyzico\Query;
use PayConn\Request\AbstractRequest;
use Iyzipay\Model\Payment as IyzicoPayment;
use PayConn\Response\Iyzico\QueryResponse;

/**
 * Class QueryRequest
 * @package PayConn\Request\Iyzico
 */
class QueryRequest extends AbstractRequest
{
    /**
     * Prepare
     * @return RetrievePaymentRequest
     */
    public function prepare()
    {
        /** @var Query $model */
        $model = $this->getModel();

        // request
        $request = new RetrievePaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setPaymentId($model->getPaymentId());

        return $request;
    }

    /**
     * @return QueryResponse
     */
    public function send()
    {
        /** @var Query $model */
        $model = $this->getModel();
        $postData = $this->prepare();

        // send
        $cancel = $this->request($postData, $model);
        return new QueryResponse(json_decode($cancel->getRawResult(), true));
    }

    /**
     * Request
     * @param RetrievePaymentRequest $postData
     * @param Query $model
     * @return mixed
     */
    protected function request(RetrievePaymentRequest $postData, Query $model)
    {
        $responseModel = IyzicoPayment::retrieve($postData, $model->getOptions());

        return $responseModel;
    }
}