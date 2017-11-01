#! /bin/bash
ps -eaf |grep "websocket-server.php" | grep -v "grep"| awk '{print $2}'|xargs kill -9
/usr/local/php websocket-server.php