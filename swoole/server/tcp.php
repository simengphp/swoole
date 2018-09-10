<?php
//创建Server对象，监听 127.0.0.1:9501端口
    $serv = new swoole_server("127.0.0.1", 9501);

    $serv->set(array(
        'reactor_num' => 2, //reactor thread num
        'worker_num' => 4,    //worker process num
        'backlog' => 128,   //listen backlog
        'max_request' => 50,
        'dispatch_mode' => 1,
    ));

//监听连接进入事件
    $serv->on('connect', function ($serv, $fd, $from_id) {
        echo "Client: fd:{$fd}--from_id:{$from_id}Connect.\n";
    });

//监听数据接收事件
    $serv->on('receive', function ($serv, $fd, $from_id, $data) {
        $serv->send($fd, "fd:{$fd}--form_id:{$from_id}--Server: ".$data);
    });

//监听连接关闭事件
    $serv->on('close', function ($serv, $fd) {
        echo "Client: fd:{$fd}Close.\n";
    });

//启动服务器
    $serv->start();