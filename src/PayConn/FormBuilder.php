<?php
namespace PayConn;

use Twig_Loader_Filesystem as FileSystem;
use Twig_Environment as Twig;

/**
 * Class FormBuilder
 * @package PayConn
 */
class FormBuilder
{
    /**
     * @var string
     */
    private $formPath;

    /**
     * FormBuilder constructor.
     */
    public function __construct()
    {
        $this->setFormPath(__DIR__ . '/../../forms');
    }

    /**
     * @return string
     */
    public function getFormPath()
    {
        return $this->formPath;
    }

    /**
     * @param string $formPath
     */
    public function setFormPath($formPath)
    {
        $this->formPath = $formPath;
    }

    /**
     * Build
     * @param $fileName
     * @param $data
     * @return string
     */
    public function build($fileName, $data)
    {
        $twig = new Twig(new FileSystem($this->getFormPath()));
        return $twig->render($fileName, $data);
    }
}