<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 25.08.2017
 * Time: 11:48
 */
require_once dirname(__DIR__) . '/../vendor/autoload.php';

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;


class BasePusher implements WampServerInterface
{

    private $webSocketParams;

    public function __construct()
    {
         $this->webSocketParams= include_once(dirname(__DIR__) . '/../config/webSocketServerParams.php');
    }

    protected $_topics = [];

    public function addTopic($topic){
        $this->_topics[$topic->getID()] = $topic;
    }

    public function getTopics(){
        return $this->_topics;
    }

    public function onSubscribe(ConnectionInterface $conn, $topic) {
        $this->addTopic($topic);
    }
    public function onUnSubscribe(ConnectionInterface $conn, $topic) {

    }
    public function onOpen(ConnectionInterface $conn) {
        if ($this->webSocketParams['debugMode'])
            echo "New connection {$conn->resourceId} \n";
    }
    public function onClose(ConnectionInterface $conn) {
        if ($this->webSocketParams['debugMode'])
            echo "New connection {$conn->resourceId} \n";
    }
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error {$e->getCode()} {$e->getMessage()}";
        if ($this->webSocketParams['debugMode'])
            echo $e->getTraceAsString();
        $conn->close();
    }
}