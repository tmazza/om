<?php

return array(
    '/' => 'site/index',
    '/do/<q>' => 'search/ResultEq',
    '<action:(login|logout)>' => 'site/<action>',
    'topico/<id:\d+>/<nome>' => 'topico/ver',
    'topico/<id>/<nome>' => 'topico/ver',
    'play/<id>' => 'play/index',
    '/do' => 'search/ResultEq',
);
