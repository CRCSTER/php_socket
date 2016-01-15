<?php
/**
 * Created by PhpStorm.
 * User: caoruncheng
 * Date: 16/1/14
 * Time: 下午10:49
 */

//确保在连接客户端时不会超时
set_time_limit(0);

$ip = '127.0.0.1';
$port = 1935;

/*
 +-------------------------------
 *    @socket通信整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */

/*----------------    以下操作都是手册上的    -------------------*/
$sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
if($sock === false)
{
    echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
}

$ret = socket_bind($sock,$ip,$port);
if($ret === false)
{
    echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
}

$ret = socket_listen($sock,4);
if($ret === false)
{
    echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}

$msgsock = socket_accept($sock);
if ($msgsock === false ) {
    echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
} else {

    //发到客户端
    $msg ="来自服务器的问候！\n";
    $write = socket_write($msgsock, $msg, strlen($msg));
    if($write === false)
    {
        echo "socket_write() 失败的原因是:".socket_strerror($ret)."\n";
    }

    $buf = socket_read($msgsock,8192);
    if($buf === false)
    {
        echo "socket_read() 失败的原因是:".socket_strerror($ret)."\n";
    }
    else
    {
        echo "来自客户端的问候是:". $buf ."\n";
    }

}
//echo $buf;
socket_close($msgsock);


socket_close($sock);
?>