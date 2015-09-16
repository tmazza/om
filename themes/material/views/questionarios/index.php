<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
    <h5 class='center-align'>Questionários</h5>
    <p class='grey-text text-darken-3'>
      Teste os seus conhecimentos! Resolva os questionários quantas vezes quiser e obtenha os gabaritos na hora.
    </p>
  </div>
  <br>
  <?php foreach ($questionarios as $qst):?>
    <a href='<?=$this->createUrl('questionarios/ver',array('id'=>$qst->id))?>'>
      <div class='card-panel'>
        <?=$qst->nome?>
      </div>
    </a>
    <?php //echo CHtml::link($qst->nome, $this->createUrl('questionarios/ver',array('id'=>$qst->id)),array(
      // 'class' => 'collection-item',
    //));?>
  <?php endforeach; ?>
</div>
