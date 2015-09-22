<?php

return array(
    '/' => '/site/index',
    '<action:(login|logout)>' => '/site/<action>',
    'topico/<id:\d+>/<nome>' => '/topico/ver',
    'topico/<id>/<nome>' => '/topico/ver',
    'play/<id>' => '/play/index',
    '/home' => '/home/default/index',
    '/questionarios' => '/questionarios/index',
    '/questionario/<id>' => '/questionarios/ver',
    '/<q>' => 'site/index',
);
