<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/28
 * Time: 10:56
 */

namespace Beanqueue;


use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

trait LoggerTrait
{
    /**
     * @var LoggerInterface $logger ;
     */
    protected $logger;

    protected function initLogger($options)
    {
        if (!isset($options['logger'])) {
            $options['logger'] = new Logger(get_class($this) . '-' . getmypid());
            $options['logger']->pushHandler(new ErrorLogHandler());
        }
        $this->setLogger($options['logger']);
        unset($options['logger']);
    }

    /**
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}