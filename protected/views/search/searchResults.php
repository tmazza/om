<section class="widget">
    <?php
    $this->widget('application.widgets.SearchBox.SearchBox', array(
        'enableAjax' => false,
        'formAction' => $this->createUrl('search/Results'),
        'title' => null,
        'term' => $search,
    ));
    $patterns = $pas = array();
    foreach ($palavras as $k => $p) {
        $patterns[$k] = "/($p)/iU";
        $pas[$k] = "<span style='color: #fff; background: #468847;'>{$p}</span>";
    }
    ?>
    <?php if (count($topicos) > 0): ?>
        <h5>Resultados para "<?= $search ?>".</h5>
        <ul id="articles" >
            <?php foreach ($topicos as $top): ?>
                <li class="search-result">
                    <p style="font-size: 16px;">
                        <?php
                        echo CHtml::link(preg_replace($patterns, $pas, $top->nome), $this->createUrl('topico/ver', array(
                                    'id' => $top->id,
                                    'nome' => ViewHelper::makeID($top->nome),
                        )));
                        ?>
                    </p>
                    <?php
                    $top->camadaRaiz->conteudo = $top->camadaRaiz->expandeCamadasVisualizacao($top->camadaRaiz->conteudo);

                    $subtopicos = $top->camadaRaiz->getSubtopicos();
                    foreach ($subtopicos as $sub) {
                        if (isset($sub->titulo)) {
                            echo '<div>';
                            echo CHtml::link(preg_replace($patterns, $pas, $sub->titulo->valor), $this->createUrl('topico/ver', array(
                                        'id' => $top->id,
                                        'nome' => ViewHelper::makeID($top->nome),
                                    )) . '#' . ViewHelper::makeID($sub->titulo->valor));
                            echo '</div>';
                        }
                    }
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h5>
            <b>Nenhum resultado para "<?= $search ?>".</b>
        </h5>
        <p>Para entender constantes ou funções $f(x)$, $F(x,y)$, use a Busca de O Monitor.</p>
    <?php endif; ?>
</section>