<?php
/**
 * Created by PhpStorm.
 * User: caoruncheng
 * Date: 16/1/14
 * Time: 下午10:49
 */

set_time_limit(0);

$port = 1935;
$ip = "127.0.0.1";

/*
 +-------------------------------
 *    @socket连接整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_connect
 *    @socket_write
 *    @socket_read
 *    @socket_close
 +--------------------------------
 */

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "客户端创建成功.\n";
}

echo "试图连接 '$ip' 端口 '$port'...\n";
$result = socket_connect($socket, $ip, $port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($socket) . "\n";
}else {
    echo "客户端连接OK\n";
}

$sendMsg = "first blood\n";

$write = socket_write($socket, $sendMsg, strlen($sendMsg));
if($write === false) {
    echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "发送到服务器信息成功！\n";
}

while($out = socket_read($socket, 8192)) {
    echo "接收服务器回传信息成功！\n";
    echo "接受的内容为:".$out;
}


echo "关闭SOCKET...\n";
socket_close($socket);
echo "关闭OK\n";
?>