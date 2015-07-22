<div class="container box-interacao">
    <script>
        sagecell.makeSagecell({
            inputLocation: '.sage-code',
            evalButtonText: 'Atualizar',
            autoeval: true,
            hide: ["editor", "language", "evalButton", "permalink", "done", "sessionFiles"],
            languages: ['<?= $note->getLanguage(); ?>'],
        });
    </script>
    <div class='camada camada-sage'>
        <p class="textRight"><?=
            CHtml::ajaxLink('Copiar para o meu notebook', $this->createUrl('play/copy', array(
                        'id' => $note->publicId,
                    )), array(
                'update' => '#feedback-copy',
                'beforeSend' => 'js: function() { $("#feedback-copy").html("Copiando..."); }',
            ));
            ?></p>
        <div id="feedback-copy"></div>
        <div class='sage-hide-code'>
            <div class='fake-link-content'>
                <div class='sage-code'>
                    <script type='text/x-sage'><?php echo CHtml::decode(stripslashes($note->codigo)); ?></script>
                </div>
            </div>
        </div>
        <div class="textRight" style="color: #aaa;">
            Utilizando linguagem <?= CHtml::link(ucfirst($note->getLanguage()), '#'); ?>. Autor: <?= CHtml::link($note->autor->perfil->nome, $this->createUrl('/' . $note->user_id)); ?>
        </div>
    </div>
</div>
<style>
    .box-interacao {
        margin: 0px auto;
        max-width: 820px;
    }
    .sagecell_poweredBy {
        display: none;
    }
</style>

