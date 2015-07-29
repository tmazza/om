<ul id="live-search-results" class="clearfix">
    <?php foreach ($topicos as $top): ?>
        <li class="search-result">
            <?php
            echo CHtml::link($top->nome, $this->createUrl('topico/ver', array(
                        'id' => $top->id,
            )));
            ?>
        </li>
    <?php endforeach; ?>
</ul>