<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 25.08.2017
 * Time: 12:18
 */
require_once dirname(__DIR__) . '/WebSocket/Pusher.php';
require_once dirname(__DIR__) . '/../framework/yii.php';
$webSocketParams = include_once(dirname(__DIR__) . '/../config/webSocketServerParams.php');
$loop   = React\EventLoop\Factory::create();
$pusher = new Pusher();
$context = new React\ZMQ\Context($loop);
$pull = $context->getSocket(ZMQ::SOCKET_PULL);
$pull->bind("tcp://{$webSocketParams['zmqServerAddress']}:{$webSocketParams['zmqServerPort']}");
$pull->on('message', array($pusher, 'broadcast'));

// Set up our WebSocket server for clients wanting real-time updates
$webSock = new React\Socket\Server($loop);
$webSock->listen($webSocketParams['port'], $webSocketParams['address']);
$webServer = new Ratchet\Server\IoServer(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            new Ratchet\Wamp\WampServer(
                $pusher
            )
        )
    ),
    $webSock
);

$loop->run();
