<?php

echo CHtml::ajaxLink("<i data-toggle='tooltip' title='Marcar como favorito' class='fa fa-star-o' style='color: #ffcc33'></i>", $this->createUrl('default/favoritar', array(
            'id' => $note->id
        )), array(
    'beforeSend' => 'js: function(){ $("#fav-' . $note->id . '").html("..."); }',
    'success' => 'js: function(html) { $("#fav-' . $note->id . '").html(html); }',
        ), array(
    'id' => 'favoritar-' . $note->id,
));

