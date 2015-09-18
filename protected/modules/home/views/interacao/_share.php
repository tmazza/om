<?php
$id = $note->id . 'noteundocomp' . hash('crc32',microtime(true));
 ?>
<div id='<?=$id?>'>
  <a href="<?=$this->createUrl("/play/{$note->publicId}")?>" class="btn-flat waves-effect" title="Link público da interacao">
    <i class="material-icons left">link</i> omonitor.io/play/<?=$note->publicId?>
  </a>
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
