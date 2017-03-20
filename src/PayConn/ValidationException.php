<?php
namespace PayConn;

use \Exception;

/**
 * Class ValidationException
 * @package PayConn
 */
class ValidationException extends Exception
{
    /**
     * @var array
     */
    private $errors;

    /**
     * ValidationException constructor.
     * @param string $errors
     * @param null $message
     * @param null $code
     * @param null $previous
     */
    public function __construct($errors, $message = null, $code = null, $previous = null)
    {
        $this->setErrors($errors);
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
}