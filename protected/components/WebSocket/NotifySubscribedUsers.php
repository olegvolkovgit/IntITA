<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 25.08.2017
 * Time: 23:22
 */
trait NotifySubscribedUsers {
    /**
     * Notifying subscribed users
     * @param $topic string Subscribed Topic
     * @param $data array Associative array with data to send
     */
    function notifyUser($topic, $data) {
        if( extension_loaded('zmq')){
            $data = ['topic_id' => $topic, 'data' => json_encode($data)];
            Pusher::updateData($data);
        }
        else{
            error_log('Please install ZMQ extension',0);
        }

    }
}