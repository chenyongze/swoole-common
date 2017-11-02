<?php
/**
 * Created by sapphire.php@gmail.com
 * User: yongze
 * Date: 2017/11/2
 * Time: 下午1:04
 */
require __DIR__.'/../vendor/autoload.php';
$redis = new Swoole\Async\RedisClient('127.0.0.1');
function redis_result($result, $success)
{
    echo "redis ok:\n";
    var_dump($success, $result);
}
$redis->select('2', function () use ($redis) {
    $redis->set('key', 'value-rango', function ($result, $success) use ($redis) {
        for ($i = 0; $i < 3; $i++) {
            $redis->get('key', 'redis_result');
        }
    });
});