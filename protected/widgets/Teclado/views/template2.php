<div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <div class="uk-grid" id="tec-btn-box-<?= $this->inputID ?>">
      <div class="uk-width-2-3">
        <ul class="uk-switcher" id='tec<?= $this->inputID ?>'>
            <?php foreach ($categorias as $c): ?>
                <li>
                    <?php
                    foreach ($c->teclas as $t) {
                        $this->render('_templateBotao', array(
                            'label' => $t->label,
                            'code' => $t->code,
                            'size' => $c->tamanho,
                        ));
                    }
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
      </div>
      <ul class="uk-tab uk-tab-right uk-width-1-3" data-uk-switcher='{animation:"fade",connect:"#tec<?= $this->inputID ?>"}'>
        <?php foreach ($categorias as $c): ?>
          <li class="" style=""><a href="#"><?= $c->nome ?></a></li>
        <?php endforeach; ?>
      </ul>
  </div>
</div>
<?php $this->render($this->script); ?>
