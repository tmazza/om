<blockquote id="params" style="background: #F5F5F5;">
    <?php foreach ($params as $p => $v): ?>
        <?php $v = isset($data[$p]) ? $data[$p] : $v; ?>
        <div class="label label-default"><?= $inst->getLabel($p) ?></div>: <input type="text" data-id="<?= $p ?>" class="value param" value="<?= $v ?>"><br>
    <?php endforeach; ?>
    <?php
    echo CHtml::ajaxLink('Atualizar', Yii::app()->controller->createUrl('ParseInstrucao'), array(
        'update' => '#arq-code',
        'type' => 'POST',
        'data' => array('id' => $inst->id, 'data' => 'js: getP()'),
        'beforeSend' => 'js: function() { $("#template").html("Carregando...") } ',
            ), array('class' => '', 'id' => hash('crc32', microtime(true) . $inst->id)));
    ?>
</blockquote>