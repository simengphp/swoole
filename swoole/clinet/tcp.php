<?php
$client = new swoole_clinet(SWOOLE_SOCK_TCP);

if (!$client->connect('127.0.0.1', 9501)) {
    echo 'connect fail';
    exit();
}

fwrite(STDOUT, '请输入你要发送的信息');

$msg = trim(fgets(STDIN));

$int = $client->send($msg);

if (!$int) {
    echo '发送失败';
    exit();
}

$result = $client->recv();
echo $result;
