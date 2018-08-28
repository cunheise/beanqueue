<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/24
 * Time: 11:25
 */

namespace Beanqueue;

use Pheanstalk\Pheanstalk;

/**
 * Class Queue
 * @package Beanqueue
 */
class Queue implements QueueInterface
{
    use LoggerTrait;
    /**
     * @var string $name
     */
    protected $name = 'default';
    /**
     * @var Pheanstalk $pheanstalk
     */
    protected $pheanstalk;

    /**
     * Queue constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->pheanstalk = $options['pheanstalk'];
        if (isset($options['name'])) {
            $this->name = $options['name'];
        }
        $this->pheanstalk->useTube($this->name);
        $this->initLogger($options);
    }

    /**
     * @param TaskBundle $taskBundle
     * @return QueueInterface
     */
    public function push(TaskBundle $taskBundle)
    {
        $this->getLogger()->info("PUSH TASK: " . json_encode($taskBundle));
        $this->pheanstalk->put(json_encode($taskBundle));
        return $this;
    }

    /**
     * @return TaskBundle
     */
    public function pop()
    {
        if ($this->name != 'default') {
            $this->pheanstalk->watch($this->name)->ignore('default');
        }
        $job = $this->pheanstalk->reserve();
        $taskBundle = new TaskBundle(json_decode($job->getData(), true));
        $this->getLogger()->info("POP TASK: " . json_encode($taskBundle));
        $this->pheanstalk->delete($job);
        return $taskBundle;
    }

}