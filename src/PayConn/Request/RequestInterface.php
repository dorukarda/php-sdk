<?php
namespace PayConn\Request;

use PayConn\Model\ModelInterface;

/**
 * Interface RequestInterface
 * @package PayConn\Request
 */
interface RequestInterface
{
    public function prepare(ModelInterface $model);

    public function send($postData);
}