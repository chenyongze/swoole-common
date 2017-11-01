<?php
/**
 * Created by sapphire.php@gmail.com
 * User: yongze
 * Date: 2017/10/31
 * Time: 下午6:54
 */
require __DIR__.'/../vendor/autoload.php';
$websocket = new \Yongze\swoole\WebSocketServer('127.0.0.1', 9505);
echo $websocket->run();