<div  class="tec-btn-box" id="tec-btn-box-<?= $this->inputID ?>">
    <dl class="accordion clearfix">
        <?php foreach ($categorias as $c): ?>
            <dt class=""><span></span><?= $c->nome ?></dt>
            <dd style="display: none;">
                <?php
                foreach ($c->teclas as $t) {
                    $this->render('_templateBotao', array(
                        'label' => $t->label,
                        'code' => $t->code,
                        'size' => $c->tamanho,
                        'btnClass' => 'btn-primary',
                    ));
                }
                ?>
            </dd>
        <?php endforeach; ?>
    </dl>
</div>
<?php $this->render($this->script); ?>