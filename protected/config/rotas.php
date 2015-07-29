<?php

return array(
//    '<controller:\w+>/<id:\d+>' => '<controller>/view',
//    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    '/' => 'site/index',
    '<action:(login|logout)>' => 'site/<action>',
    '<username>' => 'autor/index',
    'topico/<id:\d+>/<nome>' => 'topico/ver',
    'topico/<id>/<nome>' => 'topico/ver',
//    'topico/<id>' => 'topico/ver',
    'play/<id>' => 'play/index',
);
