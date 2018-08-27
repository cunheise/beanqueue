<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/24
 * Time: 13:26
 */

use Beanqueue\TaskBundle;

require dirname(__DIR__) . '/vendor/autoload.php';
require __DIR__ . '/bootstrap.php';
foreach (range(0, 1000) as $i) {
    $taskBundle = new TaskBundle(['class' => '\EchoTask', 'arguments' => [$i]]);
    $queue->push($taskBundle);
    sleep(1);
}