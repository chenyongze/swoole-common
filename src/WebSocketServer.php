<?php
/*************************************************************************
  > File Name: src/WebSocketServer.php
  > Author: yongze.chen 
  > Mail: sapphire.php@gmail.com 
  > Created Time: 二 10/31 12:04:13 2017
 ************************************************************************/
namespace Yongze\swoole;

class WebSocketServer {
    public $server;

    public function __construct($host='127.0.0.1',$port=9505) {
        $this->server = new \swoole_websocket_server($host, $port);
    }
    /**
     * run start
     */
    public function run(){
        $this->server->on('open', function (\swoole_websocket_server $server, $request) {
            echo "server: handshake success with fd{$request->fd}\n";
            echo ("在线人数:".count($server->connections)."\n");
            $this->map[$request->fd] = $request->fd;//首次连上时存起来
            $server->push($request->fd, "hello, welcome .客户: {$request->fd} \n");
//            file_put_contents( __DIR__ .'/log.txt' , $request->fd);
        });

        //监听WebSocket消息事件
        $this->server->on('message', function (\swoole_websocket_server $server, $frame) {
            echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
//            $server->push($frame->fd, "todo this is server");
            $date = date('Y-m-d H:i:s',time());
            $msg = 'from'.$frame->fd.":{$frame->data}:{$date} \n";
//            $msg .= var_export($this->map,true);
//            $msg .= var_export($server->connections,true);
            foreach ($server->connections as $fd) {
//                $this->server->push($fd, $msg);
                @$server->push($fd , $msg);//循环广播
            }

        });

        //监听WebSocket连接关闭事件
        $this->server->on('close', function ($ser, $fd) {
            echo "client {$fd} closed\n";
            //删除已断开的客户端
//            unset($this->$map[$fd-1]);
        });

        $this->server->on('request', function ($request, $response) {
            // 接收http请求从get获取message参数的值，给用户推送
            // $this->server->connections 遍历所有websocket连接用户的fd，给所有用户推送
            foreach ($this->server->connections as $fd) {
                $this->server->push($fd, 'data:'.$request->get['message']);
            }
        });

        $this->server->start();

    }
}

