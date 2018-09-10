<?php
$http = new swoole_http_server('0.0.0.0', 8800);
$http->on('request', function ($request, $response) {
    $response->end('Hello http_server');
});
$http->start();
