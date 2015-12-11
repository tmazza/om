<p class="flow-text center-align">
  <?= CHtml::link('Faça login para copiar esta interação', $this->createUrl('/site/login',array(
    'b' => base64_encode($this->createUrl('/play/index',array('id'=>Yii::app()->request->getParam('id')))),
  ))); ?>
</p>>
