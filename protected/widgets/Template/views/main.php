<?php $params = ShView::extraiParametros($template); ?>
<blockquote id="params" style="background: #F5F5F5;">
    <?php if (!is_null($this->title)): ?>
        <h3><?= $this->title; ?></h3>
    <?php endif; ?>
    <?php
    $this->widget('shared.widgets.Widget.WidgetView', array(
        'str' => $template,
        'data' => $this->data,
    ));
    ?>
    <?php
    echo CHtml::ajaxLink('Atualizar', Yii::app()->controller->createUrl($this->url), array(
        'update' => '#' . $this->update,
        'type' => 'POST',
        'data' => array('code' => "$template", 'data' => 'js: getParametros() '),
        'beforeSend' => 'js: function() { $("#' . $this->update . '").html("Carregando...") } ',
            ), array('class' => 'btn btn-sm btn-primary', 'id' => hash('md5', microtime(true))))
    ?>
</blockquote>
