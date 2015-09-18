<?php

$ajaxBehaviour = array(
    'data' => array('id' => $note->id, 'code' => 'js: function() { return $("#note-code-' . $note->id . '").val(); }'),
    'success' => 'js: function(data) { '
    . '$("#note-' . $note->id . ' .overlay").remove();'
    . 'alert(data); '
    . '}',
);
echo CHtml::ajaxLink('Salvar', $this->createUrl('/home/interacao/save'), $ajaxBehaviour, array(
    'id' => hash('crc32',microtime(true)).'save-code-' . $note->id,
    'class' => 'btn indigo right',
));
