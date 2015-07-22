<?php

// menu de contexto
$this->menuContexto = array();
$this->titleMenuContexto = null;
if (count($topico->interacoesComDestaque) > 0) {
    $this->menuContexto[] = array(
        'label' => 'Principais interações deste tópico',
        'url' => $this->createUrl('topico/principaisInteracoes', array('id' => $topico->id)) . '#conteudo-topico',
        'class' => 'li-sage',
    );
}

$subtopicos = $topico->camadaRaiz->getSubtopicos();
// índice no tópico
foreach ($subtopicos as $sb) {
    if (!is_null($sb->titulo)) {
        $this->subindice[] = array('label' => $sb->titulo->valor, 'url' => '#' . ViewHelper::makeID($sb->titulo->valor));
    }
}
if (isset($topico->relacionados)) {
    foreach ($topico->relacionados as $r) {
// Tópicos relacionados
        $this->titleTags = 'Principais tópicos relacionados';
        if (isset($r->filho)) {
            $this->tags[] = array(
                'label' => $r->filho->nome,
                'url' => $this->createUrl('topico/ver', array('id' => $r->filho->id)),
            );
        }
    }
}
?>
<?php $this->beginContent('_base', array('topico' => $topico)); ?>
<?php echo $topico->loadLatexMacros(); ?>
<?php echo $topico->camadaRaiz->conteudo; ?>
<?php $this->endContent(); ?>

<?php

$this->widget('application.widgets.Feedback.Feedback', array(
    'topico' => $topico->nome,
    'autor_nome' => $topico->autor->perfil->nome, 'autor_id' => $topico->user_id))
?>
