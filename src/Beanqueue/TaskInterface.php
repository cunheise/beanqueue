<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/27
 * Time: 10:17
 */

namespace Beanqueue;

/**
 * Interface TaskInterface
 * @package Beanqueue
 */
interface TaskInterface
{
    /**
     * @return void
     */
    public function run(array $arguments);
}