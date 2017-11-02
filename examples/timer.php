<?php
/**
 * Created by sapphire.php@gmail.com
 * User: yongze
 * Date: 2017/11/2
 * Time: 下午1:45
 */

//每隔2000ms触发一次
swoole_timer_tick(2000, function ($timer_id) {
    $date = date('Y-m-d H:i:s');
    echo "tick-2000ms - {$date} \n";

});
