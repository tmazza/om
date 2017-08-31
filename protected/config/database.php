<?php
$hostName = getenv('OM_DB_HOST');
$database = getenv('OM_DB_NAME');
$userName = getenv('OM_DB_USER');
$passWord = getenv('OM_DB_PASS');
$port = getenv('OM_DB_PORT');

return array(
    'class' => 'CDbConnection',
    'connectionString' => "mysql:host=$hostName;dbname=$database;port=$port",
    'emulatePrepare' => true,
    'username' => $userName,
    'password' => $passWord,
    'charset' => 'utf8',
    'enableProfiling' => true,
    'enableParamLogging' => true,
);
