<?php if (count($topicos) > 0): ?>
    <div class='camada camada-sage'>
        <div class='sage-hide-code'>
            <h5>Tópicos relacionados</h5>
            <?php
            foreach ($topicos as $id => $t) {
                echo CHtml::link($t, Yii::app()->controller->createUrl('topico/ver', array('id' => $id)), array('class' => 'btn btn-mini', 'style' => 'margin: 4px;'));
            }
            ?>
        </div>
    </div>
<?php endif; ?>