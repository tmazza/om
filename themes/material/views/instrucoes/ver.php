<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
    <h5 class=''>
      <?=$instrucao->descricao;?>
    </h5>
  </div>

  <a href='<?=$this->createUrl('site/index',array('q'=>$instrucao->nomes[0]->id));?>'>
    <div class="card-panel center-align">
      <span class="btn btn-primary">Executar interação</span>
    </div>
  </a>

  <div class="row">
    <div class="col s12 m6">
      <div class="card-panel">
        <span class="center-align flow-text">Interações relacionadas</span>
        <br>
        <div class="divider"></div>
        <br>
        <?php
        $apelidos = CHtml::listData($instrucao->nomes,'id','id');
        $apelidos[] = 'asads';
        $apelidos = array_map(function($i) { return "valor LIKE '{$i}%'"; },$apelidos);
        $exemplos = ExemplosSearch::model()->findAll(implode(' OR ', $apelidos));
        $relacionados = [];
        foreach ($exemplos as $e) {
          if(!is_null($e->categoria)){
             $relacionados = array_merge($relacionados,$e->categoria->exemplos);
          }
        }
        $print = [];
        foreach ($relacionados as $r) {
          if($r->id !== $instrucao->id && !in_array($r->id,$print)){
            echo CHtml::link($r->valor,$this->createUrl('/site/index',array('q'=>$r->valor))) .  '<br>';
            $print[] = $r->id;
          }
        }
        ?>
      </div>
    </div>
    <div class="col s12 m6">
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
