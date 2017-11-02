<?php
/**
 * Created by sapphire.php@gmail.com
 * User: yongze
 * Date: 2017/11/2
 * Time: 下午1:02
 */
require __DIR__.'/../vendor/autoload.php';

$http = new swoole_http_server("127.0.0.1", 9501);
$http->set(['worker_num' => 8]);

$redis = new Swoole\Async\RedisClient('127.0.0.1');
$http->on('request', function ($request, swoole_http_response $response) use ($redis) {
    if (isset($request->get['status'])) {
        $response->end($redis->stats());
    } else {
        $redis->get(
            'key',
            function ($result, $success) use ($response) {
                if (!$success) {
                    echo "get from redis faiuuuuuuuuuuuuuuuuuuu   gled\n";
                }
                $response->end("<h1>Hello Swoole. value=" . $result . "</h1>");
            }
        );
    }
});

$http->start();