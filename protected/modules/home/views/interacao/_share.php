<?php
$id = $note->id . 'noteundocomp' . hash('crc32',microtime(true));
 ?>
<div id='<?=$id?>'>
    <input value='omonitor.io/play/<?=$note->publicId?>' type="text" style='max-width:320px;'>
    <a target='_blank' href="<?=$this->createUrl("/play/{$note->publicId}")?>" class="btn-flat waves-effect" title="Ir para interacao"><i class="material-icons">open_in_new</i></a>
    <?php
    echo CHtml::ajaxLink('<i class="material-icons">clear</i>', $this->createUrl('/home/interacao/undoShare', array('id' => $note->id)), array(
    'success' => 'js: function(html) { '
    . '$("#'.$id.'").html(html); '
    . 'return false; }',
        ), array(
          'title' => 'Desativar link',
          'id' => hash('crc32',microtime(true)) . 'share-' . $note->id,
          'class' => 'btn-flat waves-effect right red-text lighten-1',
        ));
    ?>
</div>
