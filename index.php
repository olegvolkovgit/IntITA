<?php
require('redis-session.php');
# переопределяем префикс, под которым будут храниться сессии в
# Redis. Это нужно сделать, т. к. в tomcat-redis-session-manager
# захардкодили, что сессии хранятся без префикса
define('REDIS_SESSION_PREFIX', '');
# в Tomcat мы имя куки поменять не можем, поэтому меняем в PHP
session_name('JSESSIONID');
# собственно начинаем сессию
RedisSession::start(array(
    'host'     => '127.0.0.1', 
    'password' => '1234567', 
    'database' => 0, 
));
// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();