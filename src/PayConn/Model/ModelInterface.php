<?php
namespace PayConn\Model;

/**
 * Interface ModelInterface
 * @package PayConn\Model
 */
interface ModelInterface
{
    public function getEndPoint();

    public function isTestMode();

    public function setTestMode($testMode);
}