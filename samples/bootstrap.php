<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/8/24
 * Time: 13:29
 */

use Beanqueue\Queue;
use Pheanstalk\Pheanstalk;

require dirname(__DIR__) . '/vendor/autoload.php';
$config = require __DIR__ . '/config.php';
$queue = new Queue(['pheanstalk' => new Pheanstalk($config['host'], $config['port']), 'name' => 'test']);