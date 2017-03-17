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

    public function getReferenceId();

    public function getResponse();

    public function setData($data);

    public function getData();
}