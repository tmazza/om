<?php
date_default_timezone_set('America/Sao_Paulo');
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', !in_array($_SERVER['HTTP_HOST'], array('omonitor.io','www.omonitor.io', 'omonitor.net','www.omonitor.net', 'omonitor.info','www.omonitor.info', 'omonitor.xyz','www.omonitor.xyz')));

// change the following paths if necessary
$yii = dirname(__FILE__) . '/src/framework/yiilite.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

//define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

if(YII_DEBUG){
  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
}
require_once($yii);

Yii::createWebApplication($config)->run();
