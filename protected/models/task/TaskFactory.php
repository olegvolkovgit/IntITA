<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 28.11.2016
 * Time: 18:42
 */



class TaskFactory
{
    const NEWSLETTER = 1;

    public static function getInstance($taskType, $parameters){
        switch($taskType) {
            case TaskFactory::NEWSLETTER:
                $params = json_decode($parameters,true);
                $type = $params['type'];
                $recipients = null;
                if (isset($params['recipients']))
                    $recipients = $params['recipients'];
                $subject = urldecode($params['subject']);
                $message = urldecode($params['message']);
                $email = $params['email'];
                return new NewsLetter($type,$recipients,$subject,$message,$email);
        }
        return null;
    }
}