<?php
namespace PayConn\Response;

use \ArrayIterator;

/**
 * Class AbstractResponse
 * @package PayConn\Response
 */
abstract class AbstractResponse extends ArrayIterator implements ResponseInterface
{
    /**
     * AbstractResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);
    }

    /**
     * To array
     * @return array
     */
    public function toArray()
    {
        return $this->getArrayCopy();
    }
}