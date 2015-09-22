<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
    <h5 class=''>
      <?=$instrucao->descricao;?>
      <?php if(count($instrucao->nomes) > 0): ?>
        <a href='<?=$this->createUrl('site/index',array('q'=>$instrucao->nomes[0]->id));?>'>
          <span class="grey-text right tooltipped" data-tooltip='Executar interação.' title='Executar interação.'>
            <i class='material-icons'>send</i>
          </span>
        </a>
      <?php endif; ?>
    </h5>
  </div>

  <div class="row">
    <div class="col s12">
      <div class="card-panel">
      <?php foreach ($instrucao->templates as $t): ?>
          <?=$t->descricao;?>
          <div class='sage-auto'>
            <script type="text/sagecell">
              <?=ShView::mergeDataToTemplate(stripslashes($t->template),array());;?>
            </script>
          </div>

      <?php endforeach; ?>
      </div>
    </div>
    <div class="col s12">
      <div class="card-panel">
        <span class="center-align flow-text">Apelidos</span>
        <br>
        <div class="divider"></div>
        <br>
        <?php $count = 1; ?>
        <?php foreach ($instrucao->nomes as $n): ?>
          <?php
            echo CHtml::link($n->id,$this->createUrl('site/index',array('q'=>$n->id)));
            if($count < count($instrucao->nomes)){
              echo '<span class="grey-text"> | </span>';
            }
          ?>
          <?php $count++;?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
