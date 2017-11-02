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


$taskId =swoole_timer_after(3000, function () {
    echo "after 3000ms.\n";
});


echo $taskId;


//do
//{
//    $date = date('Y-m-d H:i:s');
//    echo "while-2000ms - {$date} \n";
//    sleep(3);
//}while(true);