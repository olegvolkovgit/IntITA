<?php

// This is the database connection configuration.
return array(

    'class' => 'CDbConnection',
	'connectionString' => 'mysql:host=localhost;dbname=intita',
	'emulatePrepare' => true,
	'username' => 'intita',
	'password' => '1234567',
	'charset' => 'utf8',
    'enableProfiling' => true,
);
