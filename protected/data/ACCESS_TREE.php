<?php
// DESATUALIZADO: 

// aluno PASSA A TER ACESSO A edicaoTopico


$auth=Yii::app()->authManager;

// Operações em tópico
$auth->createOperation('criarTopico','criar tópico');
$auth->createOperation('lerTopico','ler tópico');
$auth->createOperation('atualizarTopico','atualizar tópico');
$auth->createOperation('excluirTopico','excluir tópico');

// Agrupa operações em tópico
$task=$auth->createTask('edicaoTopico','edição de tópicos');
$task->addChild('criarTopico');
$task->addChild('lerTopico');
$task->addChild('atualizarTopico');
$task->addChild('excluirTopico');

// Operações em árvore de conteúdo
$auth->createOperation('verArvore','ler tópico');
$auth->createOperation('criarNodoArvore','criar nodo em árvore');
$auth->createOperation('atualizarNodoArvore','atualizar nodo em árvore');
$auth->createOperation('excluirNodoArvore','excluir nodo em árvore');
// Agrupa operações de árvore de conteúdo
$task=$auth->createTask('edicaoArvore','edição de árvore de conteúdo');
$task->addChild('verArvore');
$task->addChild('criarNodoArvore');
$task->addChild('atualizarNodoArvore');
$task->addChild('excluirNodoArvore');

// Operações de dados do autor
$auth->createOperation('verPerfil','visualizar seu perfil');
$auth->createOperation('atualizarPerfil','edição de dados de perfil');
// Agrupa operações de dados do autor
$task=$auth->createTask('edicaoPerifil','edição de árvore de conteúdo');
$task->addChild('verPerfil');
$task->addChild('atualizarPerfil');


$role=$auth->createRole('autor');
$role->addChild('edicaoTopico');
$role->addChild('edicaoArvore');
$role->addChild('edicaoPerifil');


$role=$auth->createRole('aluno'); 

$role=$auth->createRole('organizacao');
$role->addChild('autor');
$role->addChild('aluno');

//$auth->assign('autor','tiagomdepaula@gmail.com');
