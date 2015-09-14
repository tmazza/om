<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
    <h5 class='center-align'>Instruções</h5>
    <p class="grey-text text-darken-3">
      Para obter um resultado no Monitor você pode utilizar qualquer expressão matemática
      ou as instruções listadas abaixo.
    </p>
  </div>
  <div class="card-panel">
    <?php foreach ($instrucoes as $i): ?>
      <?php $apelido = count($i->nomes) > 0 ? $i->nomes[0] : false; ?>
      <?php
      if($apelido){
        echo CHtml::link($i->descricao,$this->createUrl('site/index',array('q'=>$apelido->id)));
        echo ' <span class="grey-text text-darken-1">('. $apelido->id . ')</span> ';
        echo '<br><div class="divider hide-on-med-and-up" style="margin:10px 0px;"></div>';
      }
      ?>
    <?php endforeach; ?>
  </div>
</div>
