<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
    <h5 class='center-align'>Questionários</h5>
    <p class='center-align grey-text text-darken-1 hide-on-small-only'>
      O Monitor confere suas respostas para diversos tipos de questões.
    </p>
  </div>
  <br>
  <?php foreach ($questionarios as $qst):?>
    <a href='<?=$this->createUrl('questionarios/ver',array('id'=>$qst->id,'nome'=>ShCode::toUrl($qst->nome)))?>'>
      <div class='card-panel'>
        <?=$qst->nome?>
      </div>
    </a>
    <?php //echo CHtml::link($qst->nome, $this->createUrl('questionarios/ver',array('id'=>$qst->id)),array(
      // 'class' => 'collection-item',
    //));?>
  <?php endforeach; ?>
</div>
