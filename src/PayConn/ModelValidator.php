<?php
namespace PayConn;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use PayConn\Model\ModelInterface;
use Symfony\Component\Validator\Validation;

/**
 * Class ModelValidator
 * @package PayConn
 */
class ModelValidator
{
    /**
     * @var ModelInterface
     */
    private $model;

    /**
     * AnnotationValidator constructor.
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
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Validate
     * @return array|null
     */
    public function validate()
    {
        $reader = new AnnotationReader();
        AnnotationRegistry::registerLoader('class_exists');
        AnnotationReader::addGlobalIgnoredName('dummy');
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping($reader)->getValidator();
        $errors = $validator->validate($this->getModel());
        if ($errors->count() === 0) {
            return null;
        }
        $result = [];
        foreach ($errors as $error) {
            $result[$error->getPropertyPath()] = $error->getMessage();
        }
        return $result;
    }
}