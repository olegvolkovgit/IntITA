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

    public static function getInstance($taskType, $relatedModelId){
        switch($taskType) {
            case TaskFactory::NEWSLETTER:
//                if (isset($params['recipients']))
//                    $recipients = $params['recipients'];
//                $subject = urldecode($params['subject']);
//                $message = urldecode($params['message']);
//                $email = $params['email'];
//                $emailBaseCategory = $params['emailBaseCategory'];
                return $newsLetter = Newsletters::model()->findByPk($relatedModelId);
        }
        return null;
    }
}