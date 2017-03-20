<?php
namespace PayConn\Request;

use PayConn\Model\ModelInterface;
use PayConn\ModelValidator;
use PayConn\ValidationException;

/**
 * Class AbstractRequest
 * @package PayConn\Request
 */
abstract class AbstractRequest implements RequestInterface
{

    /**
     * @var ModelInterface
     */
    protected $model;

    /**
     * AbstractRequest constructor.
     * @param ModelInterface $model
     */
    public function __construct(ModelInterface $model)
    {
        $this->setModel($model);
        $this->validate();
    }

    /**
     * @return ModelInterface
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param ModelInterface $model
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Validate
     * @throws ValidationException
     */
    public function validate()
    {
        $modelValidator = new ModelValidator($this->getModel());
        $errors = $modelValidator->validate();
        if ($errors !== null) {
            throw new ValidationException($errors);
        }
    }
}