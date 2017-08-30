<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 25.08.2017
 * Time: 12:07
 */
require_once dirname(__DIR__) . '/WebSocket/BasePusher.php';

class Pusher extends BasePusher
{
    static function updateData($data){
        $webSocketParams = Yii::app()->params['webSocketServer'];
        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH,'intitaPusher');
        $socket->connect("tcp://{$webSocketParams['zmqServerAddress']}:{$webSocketParams['zmqServerPort']}");
        $socket->send(json_encode($data));
    }

    public function broadcast($jsonData){

        $data = json_decode($jsonData,true);
        $topics = $this->getTopics();
        if(isset($topics[$data['topic_id']])){
            $topic = $topics[$data['topic_id']];
            $topic->broadcast($data);
        }

    }
}