<?php
return array(
    // uncomment the following to enable the Gii tool
    'gii' => array(
        'class' => 'system.gii.GiiModule',
        'password' => '345',
        'ipFilters' => array('127.0.0.1','::1'),
    ),
    'home',
    'meuEspaco' => array(
        'modulosHabilitados' => array(
//            'publicacoes',
              'instituicao',
//            'arquivos',
//            'questionarios',
//            'gerenciamentoCursos',
//            'estrutura',
            'edicaoPerfil',
//            'controleAcesso',
//            'meusCursos',
            'mensagem',
            'grupos',
            'notebook',
            'questoes',
        ),
    ),
);
