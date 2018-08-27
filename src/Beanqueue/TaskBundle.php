<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/27
 * Time: 10:31
 */

namespace Beanqueue;

use Beanqueue\Exception\InvalidArgumentException;

/**
 * Class TaskBundle
 * @package Beanqueue
 */
class TaskBundle implements \JsonSerializable
{
    /**
     * @var string $class
     */
    protected $class;
    /**
     * @var array $arguments
     */
    protected $arguments = [];

    /**
     * TaskBundle constructor.
     * @param array $options
     */
    public function __construct($options)
    {
        if (!isset($options['class'])) {
            throw new InvalidArgumentException("class name can not be empty");
        }
        $this->setClass($options['class']);
        if (isset($options['arguments'])) {
            $this->setArguments($options['arguments']);
        }
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return TaskBundle
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     * @return TaskBundle
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return ['class' => $this->getClass(), 'arguments' => $this->getArguments()];
    }


}