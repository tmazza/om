<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 18/06/15
 * Time: 22:57
 */
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'id'=>'modalFeedback',
        // additional javascript options for the dialog plugin
        'options'=>array(
            'title'=>'Deixe seu Feedback',
            'autoOpen'=>false,
        ),
    ));
?>
<?php echo CHtml::beginForm( Yii::app()->controller->createUrl('site/feedback'),'',array('id'=>'formFeedback')); ?>
    <!-- Main content -->
    <div class="box-header with-border">
        <h3 class="box-title">Mensagem</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <input type="hidden" name="destino" value="<?=$autor_id;?>">
        </div>
        <div class="form-group">
            <textarea name="mensagem" id="mensagem"><?=$mensagem;?></textarea>
            <?php
            $this->widget('ImperaviRedactorWidget', array(
                'selector' => '#mensagem',
                'options' => array(
                    'lang' => 'pt_br',
                    'plugins' => array(
                        'bufferbuttons',
                    ),
                    'replaceDivs' => false,
                    'minHeight' => 300,
                    'removeEmpty' => array(),
                    'cleanStyleOnEnter' => true,
                    'linebreaks' => true,
                    'pastePlainText' => true,
                    'cleanOnPaste' => true,
                    'focus' => true,
                    'pasteCallback' => 'js:function(html) { /*console.log(html); console.log($("<span>"+html+"</span>").text());*/ return $("<span>"+html+"</span>").text(); }',
                    'buttons' => array('formatting', 'bold', 'italic', 'unorderedlist', 'orderedlist', 'alignment', 'link'),
                ),
            ));
            ?>
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="button" class="btn btn-info" onclick="enviarFeedback();"><i class="fa fa-envelope-o"></i> Enviar</button>
        </div>
    </div><!-- /.box-footer -->
<?php echo CHtml::endForm(); ?>
<?php
    $this->endWidget('zii.widgets.jui.CJuiDialog');

    // the link that may open the dialog
    echo CHtml::link('Deixe seu feedback', '#', array(
        'onclick'=>'$("#modalFeedback").dialog("open"); return false;','class'=>'btn btn-info')
    );
?>

<script language="JavaScript">

    function enviarFeedback() {
        var form = $("#formFeedback");
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),

            success: function (response) {
                if (response == 1) {
                    alert("Obrigado pelo seu feedback");
                    $("#modalFeedback").dialog("close");
                } else {
                    alert("Ops! algo deu errado, tente novamente!");
                }
            }
        });
    }
</script>