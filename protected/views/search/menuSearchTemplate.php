<?php if (count($topicos) > 0): ?>
    <ul id="articles" class="clearfix">
        <?php foreach ($topicos as $top): ?>
            <li class="article-entry standard">
                <?php
                echo CHtml::link($top->nome, $this->createUrl('topico/ver', array(
                            'id' => $top->id,
                )));
                ?>
                <!--<span class="article-meta">-->
                    <!--Autor: <?//= $top->autor->perfil->nome; ?>-->
                <!--</span>-->
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    Nenhum resultado encontrado.
<?php endif; ?>
<hr>