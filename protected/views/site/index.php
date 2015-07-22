<?php //$this->widget("application.widgets.MainSageCell.MainSageCell");             ?>
<?php foreach ($topicos as $top): ?>
    <div class="row-fluid topico">
        <div class="span12">
            <h5><?= CHtml::link($top->nome, $this->createUrl('topico/ver', array('id' => $top->id, 'nome' => ViewHelper::makeID($top->nome)))) ?></h5>
            <?php if (count($top->interacoesComDestaque) > 0): ?>
                <?php
                $select = rand(0, count($top->interacoesComDestaque) - 1);
                if (isset($top->interacoesComDestaque[$select]->descricao)) {
                    echo '<p>' . $top->interacoesComDestaque[$select]->descricao->valor . '</p>';
                }
                $this->renderPartial('_testePanel', array(
                    'conteudo' => $top->interacoesComDestaque[$select]->conteudo,
                    'camada_id' => $top->interacoesComDestaque[$select]->id,
                ));
                ?>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
));

