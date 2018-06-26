<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/26/18
 * Time: 10:27 AM
 */

/*HTTP/1.1 101 Switching Protocols
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Accept: s3pPLMBiTxaQ9kYGzzhZRbK+xOo=
Sec-WebSocket-Protocol: chat*/
require_once __DIR__ . '/../vendor/autoload.php';
use Workerman\Worker;

// Create a Websocket server
$ws_worker = new Worker("websocket://0.0.0.0:1915");

// 4 processes
$ws_worker->count = 4;

// Emitted when new connection come
$ws_worker->onConnect = function($connection)
{
    echo "New connection\n";
};

// Emitted when data received
$ws_worker->onMessage = function($connection, $data)
{
    // Send hello $data
    $connection->send('hello ' . $data);
};

// Emitted when connection closed
$ws_worker->onClose = function($connection)
{
    echo "Connection closed\n";
};

// Run worker
Worker::runAll();
