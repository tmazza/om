<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
    <span class="flow-text"><?=$instrucao->descricao;?></span>
    <a href='<?=$this->createUrl('site/index',array('q'=>$instrucao->nomes[0]->id));?>'>
       <span class="btn">Ver interação</span>
    </a>
  </div>


  <div class="row">
    <div class="col s12 m12">
      <div class="card-panel">
        <span class="center-align">Interações relacionadas</span>
        <br>
        <div class="divider"></div>
        <br>
        <?php
        $apelidos = CHtml::listData($instrucao->nomes,'id','id');
        $apelidos = array_map(function($i) { return "valor LIKE '{$i}%'"; },$apelidos);
        $exemplos = ExemplosSearch::model()->findAll(implode(' OR ', $apelidos));
        $relacionados = [];
        foreach ($exemplos as $e)
          if(!is_null($e->categoria))
             $relacionados = array_merge($relacionados,$e->categoria->exemplos);

        $print = [];
        foreach ($relacionados as $r) {
          if($r->id !== $instrucao->id && !in_array($r->id,$print)){
            echo CHtml::link('$' . $r->latex . '$',$this->createUrl('/site/index',['q'=>$r->valor]));
            echo ' <small>(' . $r->valor . ')</small><br>';
            $print[] = $r->id;
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>
