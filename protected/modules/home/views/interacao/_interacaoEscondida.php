<div class="box" id="load-note-<?= $note->id; ?>">
    <div class="box-header">
        <?= ucfirst($note->getLanguage()); ?>
        <div class="pull-right">
            <?php // $this->renderPartial('_deleteButton', array('note' => $note)); ?>
        </div>
    </div>
    <div class="box-body">
        <?php
        $ajaxBehaviour = array(
            'beforeSend' => 'js: function(){  '
            . '$("#load-note-' . $note->id . '").append("<div class=\'overlay\'><i class=\'fa fa-refresh fa-spin\'></i></div>");'
            . '}',
            'success' => 'js: function(html){  '
            . '$("#load-note-' . $note->id . '").removeClass("box").html(html);'
            . '}',
        );
        ?>
        <div class="textCenter">
            <?= CHtml::ajaxLink('<i class="fa fa-plus"></i>', $this->createUrl('default/load', array('id' => $note->id)), $ajaxBehaviour, array('class' => 'exp-btn')); ?>
        </div>
    </div>
</div>