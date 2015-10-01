<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
    <h5 class=''>
      <?=$instrucao->descricao;?>
      <?php if(count($instrucao->nomes) > 0): ?>
      <?php endif; ?>
    </h5>
  </div>

  <div class="row">
    <div class="col s12 m6 l3">
      <div class="card-panel center-align">
        <div class="flow-text">
          Utilizada<br>
        </div>
        <b><?=(SearchTerms::model()->count('instrucao = ' . $instrucao->id) + ceil($instrucao->id))?> vez(es)</b>
      </div>
    </div>
    <div class="col s12 m6 l4 right">
      <div class="right-align flow-text">
        <a href='<?=$this->createUrl('site/index',array('q'=>$instrucao->nomes[0]->id));?>'>
          <div class="card-panel center-align">
            <span class=" tooltipped" data-tooltip='Executar interação.' title='Executar interação.'>
              Interagir <i class='material-icons right' style="padding-top:8px;">send</i>
            </span>
          </div>
        </a>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col s12">
      <div class="card-panel">
        <?php if(count($instrucao->templates) > 0): ?>
          <?php $t=$instrucao->templates[0];?>
          <div class='sage-auto'>
            <script type="text/sagecell">
              <?=ShView::mergeDataToTemplate(stripslashes($t->template),array());?>
            </script>
          </div>
        <?php endif; ?>
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
