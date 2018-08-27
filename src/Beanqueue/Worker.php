<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/24
 * Time: 11:30
 */

namespace Beanqueue;

use RuntimeException;

/**
 * Class Worker
 * @package Beanqueue
 */
class Worker
{
    /**
     * @var QueueInterface $queue
     */
    protected $queue;

    /**
     * @var int $interval
     */
    protected $interval = 1000000;

    public function __construct(array $options)
    {
        $this->queue = $options['queue'];
        if (isset($options['interval'])) {
            $this->interval = (int)$options['interval'];
        }
    }

    public function process()
    {
        while (true) {
            $taskBundle = $this->queue->pop();
            $task = $this->createTask($taskBundle);
            $task->run($taskBundle->getArguments());
            usleep($this->interval);
        }
    }

    /**
     * @param TaskBundle $taskBundle
     */
    protected function createTask(TaskBundle $taskBundle)
    {
        $class = $taskBundle->getClass();
        if (!class_exists($class)) {
            throw new RuntimeException("'$class' can not be found");
        }
        $task = new $class();
        if (!($task instanceof TaskInterface)) {
            throw new RuntimeException("'$class' should implement TaskInterface");
        }
        return $task;
    }
}