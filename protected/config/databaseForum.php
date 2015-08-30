<?php
$dbname = 'forum';
return array(
    'class' => 'CDbConnection',
    'connectionString' => 'mysql:host=localhost;dbname='.$dbname,
    'emulatePrepare' => true,
    'dbname' => $dbname,
    'username' => 'intita',
    'password' => '1234567',
    'charset' => 'utf8',
    'enableProfiling' => true,
);
