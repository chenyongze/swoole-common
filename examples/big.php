<?php
/**
 * Created by sapphire.php@gmail.com
 * User: yongze
 * Date: 2017/11/2
 * Time: 上午11:49
 */

require __DIR__.'/../vendor/autoload.php';
$redis = new Swoole\Async\RedisClient('127.0.0.1');
$redis->debug = true;
$redis->get("big", function ($result, $success) {
//    echo strlen($result);
    echo $result;
    print_r($success);
});
exit;