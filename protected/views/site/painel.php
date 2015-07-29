<div id="topicos">
    <?php foreach ($topicos as $top): ?>
        <div class="topico">
            <h5><?= CHtml::link($top->nome, $this->createUrl('site/view', array('id' => $top->id))) ?></h5>
            <div>
                <?php
                if (count($top->interacoes) > 0) {
                    $select = rand(0, count($top->interacoes) - 1);
                    $this->renderPartial('_testePanel', array(
                        'conteudo' => $top->interacoes[$select]->conteudo,
                        'camada_id' => $top->interacoes[$select]->id,
                    ));
                } elseif (count($top->subtopicos) > 0) {
                    echo $top->subtopicos[0]->conteudo;
                }
                ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
))
?>
<?php
//$this->widget('monitor.extensions.yiinfinite-scroll.YiinfiniteScroller', array(
//    'contentSelector' => '#topicos',
//    'itemSelector' => 'div.topico',
//    'loadingText' => 'Loading...',
//    'donetext' => 'This is the end... my only friend, the end',
//    'pages' => $pages,
//));
?>
<style>
    .topico {
        background: #fdfdfd;
        display: inline-block;
        vertical-align: top;
        width: 320px;
        margin: 20px 0px;
        padding: 4px;
        border: 1px solid #ddd;
        border-radius: 2px;
        display: inline-block;
    }
</style>