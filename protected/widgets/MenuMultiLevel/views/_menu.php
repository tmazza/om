<ul class="articles" <?= (isset($open) && !$open) ? 'style="display:none;padding-left:12px;"' : ''; ?>>
    <?php foreach ($a as $i): ?>

        <li onclick="$(this).next('ul').slideToggle();" class="article-entry">
            <h4>
                <?= CHtml::link($i['label'], '#', array('onClick' => 'return false;')); ?>

            </h4>
            <?php if (isset($i['qtdFilhos'])): ?>
                <!--<span class="like-count"><?//= $i['qtdFilhos']; ?></span>-->
            <?php endif; ?>
            <?php
            if (isset($i['topicos'])) {
                foreach ($i['topicos'] as $t) {
                    echo CHtml::link($t['label'], Yii::app()->controller->createUrl('topico/ver', array('id' => $t['id']))) . '<br>';
                }
            }
            ?>
        </li>
        <?php
        if (count($i['items']) > 0) {
            $this->render('_menu', array('a' => $i['items'], 'open' => false));
        }
        ?>
    <?php endforeach; ?>
</ul>