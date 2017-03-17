<?php
namespace PayConn\Response;

/**
 * Class AbstractResponse
 * @package PayConn\Response
 */
abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * AbstractResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->setData($data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}