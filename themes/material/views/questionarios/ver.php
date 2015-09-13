<div class="container" style="margin-top:-49px;">
  <div class="card-panel center-align flow-text">
    <?=$qst->nome;?>
  </div>
  <!-- <div class="card-panel"> -->
    <?php
    if(is_null($qst)){
      echo '<p class="flow-text">Não encontrado.</p>';
    } else {
      $this->widget('shared.widgets.Questionario.ResolverQuestionario', array(
          'questionarioId' => $qst->id,
          'verDesempenho' => false,
          'template' => '2',
          'url' => Yii::app()->controller->createUrl('questionarios/CorrigirQuestao'),
      ));
    }
    ?>
  <!-- </div> -->
</div>
