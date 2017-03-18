<?php
namespace PayConn\Request;

use PayConn\Model\ModelInterface;

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
}