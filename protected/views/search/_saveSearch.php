<div class="">
	<?php
	$img = CHtml::image(Yii::app()->baseUrl.'/webroot/monitor/save-icon32x32.png');
	echo CHtml::ajaxLink($img , $this->createUrl('search/save').'?q='.urlencode($q), array(
		'update' => '#s-save',
	), array(
		'id' => 'ajax-s-save',
		'title' => 'Salvar',
	));
	?>
</div>
