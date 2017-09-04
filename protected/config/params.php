<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 05.01.2017
 * Time: 10:06
 */
$webSocketServerParams = require_once(dirname(__FILE__) . '/webSocketServerParams.php');

return array(
    'params' => array(
        // this is used in teacher profile page
        'adminEmail' => 'Wizlightdragon@gmail.com',
        'languages' => array('en' => 'English', 'ua' => 'Ukrainian', 'ru' => 'Russian'),
        'dbDateFormat'=>'Y-m-d H:i:s',
        'titleUAPattern'=>'^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇїҐґ.,\/:;`\'’&@_(){}\[\]%#№|\\\\?! ~<>*+-]',
        'titleRUPattern'=>'^[=а-яА-Яa-zA-Z0-9.,\/:;`\'’&@_(){}\[\]%#№|\\\\?! ~<>*+-]',
        'titleENPattern'=>'^[=a-zA-Z0-9.,\/:;`\'’&@_(){}\[\]%#№|\\\\?! ~<>*+-]',
        'secretKey' => md5('test'),
        'dovecotPasswordScheme'=>'sha',
        'webSocketServer'=>$webSocketServerParams,
    ),
);