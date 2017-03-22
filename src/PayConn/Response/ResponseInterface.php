<?php
namespace PayConn\Response;

/**
 * Interface ResponseInterface
 * @package PayConn\Response
 */
interface ResponseInterface
{
    public function isSuccessful();

    public function getMessage();

    public function getCode();
}