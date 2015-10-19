<?php

return array(
    '/' => '/site/index',
    '<action:(login|logout|aleatorio)>'     => '/site/<action>',
    'topico/<id:\d+>/<nome>'                => '/topico/ver',
    'topico/<id>/<nome>'                    => '/topico/ver',
    'play/<id>'                             => '/play/index',
    '/home'                                 => '/home/default/index',
    '/questionarios'                        => '/questionarios/index',
    '/questionario/<nome>-<id>'             => '/questionarios/ver',
    '/questionario/<id>'                    => '/questionarios/ver',
    '/instrucoes'                           => '/instrucoes/index',
    '/instrucao/<nome>-<id>'                => '/instrucoes/ver',
    '/instrucao/<id>'                       => '/instrucoes/ver',
    '/primeiras-impressoes'                 => '/sobre/comentarios',
    '/apresentação'                         => '/sobre/apresentacao',
    '/referências'                          => '/sobre/referencias',
    '/plataformas'                          => '/sobre/plataformas',
    '/modo-de-usar'                         => '/sobre/modoDeusar',
    '/<q>'                                  => '/site/index',
);
