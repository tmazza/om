<?php foreach ($exemplos as $e): ?>
  <?php if(count($e->exemplos) > 0 || count($e->filhas) > 0): ?>
    <ul class="collection with-header" style="margin-bottom:0px;">
      <li class="collection-header" onclick="$(this).next().slideToggle();" style="cursor:pointer;">
        <?php if($nivel == 0): ?>
          <h5 style="font-size:1.3em"><?=$e->nome;?></h5>
        <?php else: ?>
          <h6><?=$e->nome;?></h6>
        <?php endif; ?>
      </li>
      <div style="display:none;background:#ddd" class='cat'>
        <?php foreach ($e->exemplos as $eg): ?>
          <a href='<?= $this->createUrl('site/index', array('q' => $eg->valor)); ?>#OM' class="collection-item">
            <div class="row">
              <div class="col l6 s12 s">
                $<?=$eg->latex;?>$
                <div class="divider hide-on-med-and-up"></div>
              </div>
              <div class="col l6 s12">
                <span class='right'><?=$eg->valor;?></span>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
        <?php if (count($e->filhas) > 0): ?>
          <li class="collection-item">
            <?php $this->renderPartial('exemplos',[
              'exemplos'=>$e->filhas,
              'nivel'=>$nivel+1,
            ]); ?>
          </li>
        <?php endif; ?>
      </div>
    </ul>
  <?php endif; ?>
<?php endforeach; ?>
