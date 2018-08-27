<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/24
 * Time: 11:31
 */

use Beanqueue\TaskInterface;
use Beanqueue\Worker;

require __DIR__ . '/bootstrap.php';

class EchoTask implements TaskInterface
{
    public function run(array $arguments)
    {
        echo serialize($arguments) . PHP_EOL;
    }
}

$worker = new Worker(['queue' => $queue]);
$worker->process();