<?php
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => "O Monitor",
    'theme'=>'material',
    'defaultController' => 'site',
    'preload' => array('log'),
    'import' => array(
        'application.components.*',
        'application.vendors.*',
        'application.models.*',
        'application.models.form.*',
        'application.helpers.*',
    ),
    'language' => 'pt_br',
    'modules' => array(
        // 'gii' => array(
        //     'class' => 'system.gii.GiiModule',
        //     'password' => '',
        //     'ipFilters' => array('127.0.0.1','::1'),
        // ),
    ),
    'aliases' => array(
        'foundation' => 'application.extensions.yiifoundation',
    ),
    'components' => array(
        'user' => array(
            'allowAutoLogin' => true,
        ),
        'cache' => array(
            'class' => 'CFileCache',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'caseSensitive' => true,
            'showScriptName' => false,
            'rules' => require(dirname(__FILE__) . '/rotas.php'),
        ),
        'db' => require(dirname(__FILE__) . '/database.php'),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'seg_authitem',
            'itemChildTable' => 'seg_authitemchild',
            'assignmentTable' => 'seg_authassignment',
        ),
        'curl' => array(
            'class' => 'shared.extensions.curl.Curl',
        ),
        'errorHandler' => array(
            'errorAction' => '/site/error',
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
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => 'contata@omonitor.io',
    ),
);
