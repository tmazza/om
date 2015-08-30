<button class="feedback-btn feedback-bottom-right" onclick="capture();">Feedback</button>

<div class="loader-inner ball-pulse"></div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'modalFeedback',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Feedback',
        'autoOpen'=>false,
        'width' =>'700'
    ),
));
?>

<?php echo CHtml::beginForm( Yii::app()->controller->createUrl('site/feedback'),'',array('id'=>'formFeedback')); ?>

<div class="box-header with-border">
    <h3 class="box-title">Mensagem</h3>
</div><!-- /.box-header -->

<div class="box-body">
    <input type="hidden" name="destino" value="<?=$autor_id;?>">
    <input type="hidden" name="screenschot_src" id="screenschot_src">

    <div class="form-group">
        <input type="text" name="email" placeholder="Digite seu email" class="form-control">
    </div>

    <div class="form-group">
        <textarea cols="5" rows="9" name="mensagem" id="mensagem"><?=$mensagem;?></textarea>
    </div>

</div><!-- /.box-body -->

<div class="box-footer">
    <div class="pull-right">
        <button type="button" class="btn btn-info" onclick="enviarFeedback();"><i class="fa fa-envelope-o"></i> Enviar</button>
    </div>
</div><!-- /.box-footer -->

<?php echo CHtml::endForm(); ?>

<div class="box-body">
    <img src="" width="300px" height="300px" id="screenshot_feedback">
</div>

<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
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