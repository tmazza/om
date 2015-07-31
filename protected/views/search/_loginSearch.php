<div class="card-hint">
	<?php echo CHtml::image(Yii::app()->baseUrl.'/webroot/monitor/icon-user32.png'); ?>
	<?php echo CHtml::link("<b>Cadastre-se</b>",$this->createUrl('site/cadastro'));?>
</div>
<hr>
Faça parte do OM e ganhe acesso a diversos recursos. <?=CHtml::link('Conheça.', '#');?>
<br><br>
<?=CHtml::link('Já tenho cadastro.', $this->createUrl('site/login'));?>
<hr>
