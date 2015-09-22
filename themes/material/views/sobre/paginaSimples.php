<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
    <div class='row'>
      <div class='col l3 s12'>
        <ul class='collection'>
          <li class="center-align collection-header"><h5>O Monitor</h5>
          <div class="divider"></div>
          </li>
          <?= CHtml::link('Apresentação', $this->createUrl('sobre/apresentacao'),array('class'=>'black-text collection-item')); ?>
          <?= CHtml::link('Modo de Usar', $this->createUrl('sobre/modoDeusar'),array('class'=>'black-text collection-item')); ?>
          <?= CHtml::link('Plataformas', $this->createUrl('sobre/plataformas'),array('class'=>'black-text collection-item')); ?>
          <?= CHtml::link('Referências', $this->createUrl('sobre/referencias'),array('class'=>'black-text collection-item')); ?>
          <!-- <?//= CHtml::link('Parceiros', $this->createUrl('sobre/parceiros'),array('class'=>'black-text collection-item')); ?> -->
        </ul>
      </div>
      <div class='col l9 s12' style="">
        <p class="flow-text center-align"><?= Organizacao::model()->getAttributeLabel($attr); ?></p>
        <?= $org->{$attr}; ?>
      </div>
    </div>
  </div>
</div>
