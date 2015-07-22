<?php

// menu de contexto
$this->titleMenuContexto = null;
$this->menuContexto = array();
$this->menuContexto[] = array(
    'label' => 'Conteúdo completo do tópico',
    'url' => $this->createUrl('topico/ver', array('id' => $topico->id, 'interacoes' => false)) . '#conteudo-topico',
    'class' => 'livro',
);
// Tópicos relacionados
$this->titleTags = 'Principais tópicos relacionados';
foreach ($topico->relacionados as $r) {
    if (isset($r->filho)) {
        $this->tags[] = array(
            'label' => $r->filho->nome,
            'url' => $this->createUrl('topico/ver', array('id' => $r->filho->id)),
        );
    }
}
// índice no tópico
$subtopicos = $topico->camadaRaiz->getSubtopicos();
foreach ($subtopicos as $sb) {
    if (!is_null($sb->titulo)) {
        $this->subindice[] = array('label' => $sb->titulo->valor, 'url' => $this->createUrl('topico/ver', array('id' => $topico->id)) . '#' . ViewHelper::makeID($sb->titulo->valor));
    }
}
?>
<?php $this->beginContent('_base', array('topico' => $topico)); ?>
<?php
$interacoes = $topico->interacoesComDestaque;
if (count($interacoes) > 0) {
    foreach ($interacoes as $i) {
        if (isset($i->titulo)) {
            echo '<h4>' . $i->titulo->valor . '</h4>';
        }
        if (isset($i->descricao)) {
            echo '<p>' . $i->descricao->valor . '</p>';
        }
        $this->renderPartial('shared.views.subCamadas.sageLoad', array(
            'camada' => $i,
            'conteudo' => $i->conteudo,
        ));
    }
} else {
    echo '<h5>Nenhuma interação com destaque!</h5>';
}
?>
<?php $this->endContent(); ?>