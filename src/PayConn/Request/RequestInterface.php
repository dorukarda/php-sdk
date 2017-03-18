<?php
namespace PayConn\Request;

/**
 * Interface RequestInterface
 * @package PayConn\Request
 */
interface RequestInterface
{
    public function prepare();

    public function send();
}