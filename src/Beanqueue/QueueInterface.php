<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/27
 * Time: 10:15
 */

namespace Beanqueue;

/**
 * Interface QueueInterface
 * @package Beanqueue
 */
interface QueueInterface
{
    /**
     * @param array $taskBundle
     * @return QueueInterface
     */
    public function push(TaskBundle $taskBundle);

    /**
     * @return TaskBundle
     */
    public function pop();
}