<article id="conteudo-topico" class="format-standard type-post hentry clearfix">
    <header class="clearfix">
        <h3 class="article-entry standard">
            <?php echo $topico->nome; ?>
        </h3>
        <div class="post-meta textRight">
            <?php if ($topico->emCriacao): ?>
                <div style="float: left;">
                    <i class="icon-edit"></i> Conteúdo em criação
                </div>
            <?php endif; ?>
            <i class="icon-user"></i> <?= CHtml::link($topico->autor->nome, Yii::app()->baseUrl . '/' . $topico->autor->username, array()); ?>
        </div>
    </header>

    <?php echo $content; ?>
</article>