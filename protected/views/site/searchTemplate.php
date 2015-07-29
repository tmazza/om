<ul id="live-search-results" class="clearfix">
    <?php
    foreach ($topicos as $top) {
        echo '<li class="search-result faq">' . CHtml::link($top->nome, $this->createUrl('site/view', array('id' => $top->id))) . '</li>';
    }
    ?>
</ul>