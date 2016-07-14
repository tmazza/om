<?php if ($comando->tipo == InstrucaoCodigo::TipoBotao): ?>
    <div class='camada camada-sage' style="display: inline-block;">
        <div class='sage-hide-code'>
            <button type="button" class="btn btn-primary" onclick="$(this).next().slideToggle(500);"><?= $comando->descricao; ?></button>
            <div style="display: none;">
                <div class='sage-auto'>
                    <script type='text/x-sage'><?php echo CHtml::decode(stripslashes($conteudo)); ?></script>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class='camada camada-sage'>
        <div class='sage-hide-code'>
            <div class='sage-auto'>
                <script type='text/x-sage'><?php echo CHtml::decode(stripslashes($conteudo)); ?></script>
            </div>
        </div>
    </div>
<?php endif; ?>
