<div  class="tec-btn-box" id="tec-btn-box-<?= $this->inputID ?>">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <?php foreach ($categorias as $c): ?>
                <?php if (count($c->teclas) > 0) : ?>
            <li><a href="#tab_<?= str_replace(' ', '', ShCode::paraBusca($c->nome)) . $this->inputID ; ?>" data-toggle="tab"><?= $c->nome ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content">
            <?php foreach ($categorias as $c): ?>
                <?php if (count($c->teclas) > 0) : ?>
                    <div class="tab-pane" style="text-align: left;" id="tab_<?= str_replace(' ', '', ShCode::paraBusca($c->nome)) . $this->inputID; ?>">
                        <?php
                        foreach ($c->teclas as $t) {
                            $this->render('_templateBotao', array(
                                'label' => $t->label,
                                'code' => $t->code,
                                'size' => $c->tamanho,
                            ));
                        }
                        ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php $this->render($this->script); ?>