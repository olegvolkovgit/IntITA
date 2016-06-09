<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 30.08.2015
 * Time: 16:24
 */
return array(
    'db' => array(
        'class' => 'CDbConnection',
        'connectionString' => 'mysql:host=localhost;dbname=p_intita',
        'emulatePrepare' => true,
        'username' => 'intita',
        'password' => '1234567',
        'charset' => 'utf8',
        'enableProfiling' => true,
        'enableParamLogging' => true,
    ),
    'dbForum' => array(
        'class' => 'CDbConnection',
        'connectionString' => 'mysql:host=localhost;dbname=forum',
        'emulatePrepare' => true,
        'username' => 'intita',
        'password' => '1234567',
        'charset' => 'utf8',
        'enableProfiling' => true,
    ),
    'debug' => array(
        'class' => 'ext.yii2-debug.Yii2Debug',
        'panels' => array(
            'db' => array(
                // Disable code highlighting.
                'highlightCode' => false,
                // Disable substitution of placeholders with values in SQL queries.
                'insertParamValues' => false,
            ),
        ),
    ),
);