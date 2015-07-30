<?php
Yii::setPathOfAlias('shared', __DIR__ . '/../../src/shared');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => "O Monitor",
    'defaultController' => 'site',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.vendors.*',
        'application.models.form.*',
        'application.components.*',
        'application.helpers.*',
        'shared.behaviors.*',
        'shared.models.*',
        'shared.models.forms.*',
        'shared.components.*',
        'shared.helpers.*',
        'shared.extensions.imperavi-redactor-widget.*',
        'shared.extensions.yii-debug-toolbar.*',
        'shared.extensions.curl.*',
    ),
    'language' => 'pt_br',
    'modules' => require(dirname(__FILE__) . '/modulos.php'),
    'aliases' => array(
        'foundation' => 'application.extensions.yiifoundation',
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'cache' => array(
            'class' => 'CFileCache',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'caseSensitive' => true,
            //'showScriptName' => YII_DEBUG,
            'showScriptName' => true,
            'rules' => require(dirname(__FILE__) . '/rotas.php'),
        ),
        'db' => require(dirname(__FILE__) . '/dbMonitor.php'),
        'orgDb' => require(dirname(__FILE__) . '/database.php'),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'seg_authitem',
            'itemChildTable' => 'seg_authitemchild',
            'assignmentTable' => 'seg_authassignment',
        ),

        //curl extension
        'curl' => array(
            'class' => 'shared.extensions.curl.Curl',
            //'options' => array(/* additional curl options */),
        ),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error',
                    'logFile' => 'error',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'warning',
                    'logFile' => 'warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'trace',
                    'logFile' => 'trace',
                ),
                array(
                    'class' => 'CEmailLogRoute',
                    'levels' => 'error, warning',
                    'emails' => array('tiagomdepaula@gmail.com'),
                ),
//                array(
//                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
//                    'ipFilters' => array('127.0.0.1', '::1'),
//                ),
//                 array(
//                    'class'=>'CProfileLogRoute',
//                    'report'=>'summary',
//                ),
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => 'contata@XXXomonitor.com',
    ),
);
