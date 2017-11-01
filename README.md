# swoole-common

> run webSocket server
#php examples/websocket-server.php


>browser  open

Socket.html
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div id="msg"></div>
<input type="text" id="text">
<input type="submit" value="发送数据" onclick="song()">
</body>
<script>
    var msg = document.getElementById("msg");
    var wsServer = 'ws://127.0.0.1:9505';
    //调用websocket对象建立连接：
    //参数：ws/wss(加密)：//ip:port （字符串）
    var websocket = new WebSocket(wsServer);
    console.log(websocket);
    //onopen监听连接打开
    websocket.onopen = function (evt) {
        //websocket.readyState 属性：
        /*
         CONNECTING    0    The connection is not yet open.
         OPEN    1    The connection is open and ready to communicate.
         CLOSING    2    The connection is in the process of closing.
         CLOSED    3    The connection is closed or couldn't be opened.
         */
        msg.innerHTML = websocket.readyState;
    };

    function song(){
        var text = document.getElementById('text').value;
        document.getElementById('text').value = '';
        //向服务器发送数据
        websocket.send(text);
    }
    //监听连接关闭
    //    websocket.onclose = function (evt) {
    //        console.log("Disconnected");
    //    };

    //onmessage 监听服务器数据推送
    websocket.onmessage = function (evt) {
        msg.innerHTML += evt.data +'<br>';
//        console.log('Retrieved data from server: ' + evt.data);
    };
    //监听连接错误信息
    //    websocket.onerror = function (evt, e) {
    //        console.log('Error occured: ' + evt.data);
    //    };

</script>
</html>


```

> server push message
```php

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


```

