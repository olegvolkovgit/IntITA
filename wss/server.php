<?php
// Или так

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/../protected/components/WebSocket/IntitaWebSocketConnector.php';
$config = include(__DIR__.'/config/config.php');
use Workerman\Lib\Timer;
use Workerman\Worker;

$intitaConnector = new IntitaWebSocketConnector();
$connectorPool = [];

$ws_worker = new Worker("websocket://{$config['ip']}:{$config['port']}");

// 4 processes
$ws_worker->count = 4;

// Emitted when new connection come
$ws_worker->onConnect = function($connection) use ($intitaConnector,$connectorPool)
{

    $connectorPool[$connection->id]=[];
    echo "{$connection->id} New connection\n";
};

// Emitted when data received
$ws_worker->onMessage = function($connection, $data)
{
    foreach($connection->worker->connections as $con)
    {
        $con->send($data);
    }
};

// Emitted when connection closed
$ws_worker->onClose = function($connection) use ($connectorPool)
{
    unset($connectorPool[$connection->id]);
    echo "Connection closed\n";
};

$ws_worker->onWorkerStart = function($worker)
{
    // Timer every 10 seconds
    Timer::add(10, function()use($worker)
    {
        // Iterate over connections and send the time
        foreach($worker->connections as $connection)
        {
            $connection->send(time());
        }
    });
};

// Run worker
Worker::runAll();
