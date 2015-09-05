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
        'connectionString' => 'mysql:host=localhost;dbname=intita',
        'emulatePrepare' => true,
        'username' => 'intita',
        'password' => '1234567',
        'charset' => 'utf8',
        'enableProfiling' => true,
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
);