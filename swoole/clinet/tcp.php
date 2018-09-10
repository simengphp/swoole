<?php
/**建立客户端程序*/
$client = new swoole_client(SWOOLE_SOCK_TCP);

if (!$client->connect('127.0.0.1', 9501)) {
    echo 'connect fail';
    exit();
}

fwrite(STDOUT, '请输入你要发送的信息');

$msg = trim(fgets(STDIN));

/**客户端给服务器端发送数据*/
$int = $client->send($msg);

if (!$int) {
    echo '发送失败';
    exit();
}

/**服务端接受数据*/
$result = $client->recv();
echo $result;
