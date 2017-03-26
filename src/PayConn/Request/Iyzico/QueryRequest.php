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
     * QueryRequest constructor.
     * @param Query $model
     */
    public function __construct(Query $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \PayConn\Model\Iyzico\Query
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * Prepare
     * @return RetrievePaymentRequest
     */
    public function prepare()
    {
        // request
        $request = new RetrievePaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setPaymentId($this->getModel()->getPaymentId());

        return $request;
    }

    /**
     * @return QueryResponse
     */
    public function send()
    {
        $postData = $this->prepare();

        // send
        $cancel = $this->request($postData);
        return new QueryResponse(json_decode($cancel->getRawResult(), true));
    }

    /**
     * Request
     * @param RetrievePaymentRequest $postData
     * @return mixed
     */
    protected function request(RetrievePaymentRequest $postData)
    {
        $responseModel = IyzicoPayment::retrieve($postData, $this->getModel()->getOptions());

        return $responseModel;
    }
}