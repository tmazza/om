<div id='widget-view'>
    <?php
    if ($this->showParametros) {
        echo CHtml::beginForm();

        $this->render('shared.views.Widget.params', array(
            'params' => $params,
            'prefixo' => '',
        ));
        echo CHtml::hiddenField('str', $this->str);

        echo CHtml::ajaxSubmitButton('Atualizar preview', $this->url, array(
            'update' => '#widget-view',
                ), array(
            'id' => 'update-widget-view' .hash('crc32', microtime(true)),
        ));
        echo CHtml::endForm();
    }
    ?>
    <?php if ($this->showPreview): ?>
        <script>
            sagecell.makeSagecell({
                inputLocation: '.sage-code',
                evalButtonText: 'Atualizar',
                autoeval: true,
                hide: ['permalink'],
            });
        </script>
        <div class='camada camada-sage'>
            <div class='sage-hide-code'>
                <div class='sage-code'>
                    <script type='text/x-sage'><?php echo stripslashes(CHtml::decode($code)); ?></script>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
