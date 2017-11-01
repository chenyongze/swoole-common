<?php
/**
 * Created by sapphire.php@gmail.com
 * User: yongze
 * Date: 2017/10/31
 * Time: 下午6:54
 */
require __DIR__.'/../vendor/autoload.php';
$client = new \Yongze\swoole\WebSocketClient('127.0.0.1', 9505);

$message = 'good job!';
if (!$client->connect())
{
    echo "connect failed \n";
    return false;
}
if (!$client->send($message))
{
    echo $message. " send failed \n";
    return false;
}
echo "send succ \n";
