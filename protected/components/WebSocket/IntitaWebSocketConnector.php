<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 22.08.2017
 * Time: 19:28
 */
require_once __DIR__ . '/../../../protected/framework/yii.php';
Yii::$enableIncludePath = false;
Yii::createWebApplication(__DIR__ .'/../../../protected/config/main.php');

class IntitaWebSocketConnector
{
    public function updateCountOfMessages(){

    }

}