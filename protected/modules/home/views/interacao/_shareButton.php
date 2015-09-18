<?php
$id = $note->id . 'notecomp' . hash('crc32',microtime(true));
echo "<div id='{$id}'>";
echo CHtml::ajaxLink('<i class="material-icons">share</i>', $this->createUrl('/home/interacao/share', array('id' => $note->id)), array(
'success' => 'js: function(html) { '
. '$("#'.$id.'").html(html); '
. 'return false; }',
    ), array(
      'title' => 'Tornar privado',
      'id' =>  hash('crc32',microtime(true)) . 'share-' . $note->id,
      'class' => 'btn-flat waves-effect',
    ));
echo "</div>";
