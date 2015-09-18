<?php

echo CHtml::ajaxLink("<i data-toggle='tooltip' title='Remover de favoritos' class='fa fa-star' style='color: #ffcc33'></i>", $this->createUrl('default/desfavoritar', array(
            'id' => $note->id
        )), array(
    'beforeSend' => 'js: function(){ $("#fav-' . $note->id . '").html("..."); }',
    'success' => 'js: function(html) { $("#fav-' . $note->id . '").html(html); }',
        ), array(
    'id' => 'desfavoritar-' . $note->id,
));

