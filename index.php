<?php

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', !in_array($_SERVER['REMOTE_ADDR'], array('omonitor.io', 'omonitor.net', 'omonitor.info', 'omonitor.xyz')));

// change the following paths if necessary
$yii = dirname(__FILE__) . '/src/framework/yiilite.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

//define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);

Yii::createWebApplication($config)->run();
