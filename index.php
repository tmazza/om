<?php
date_default_timezone_set('America/Sao_Paulo');
defined('YII_DEBUG') or define('YII_DEBUG', in_array($_SERVER['HTTP_HOST'], array('localhost:8081')));

$yii = dirname(__FILE__) . '/yii/yiilite.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

if(YII_DEBUG){
  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
}
require_once($yii);

Yii::createWebApplication($config)->run();
