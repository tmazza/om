<div class="autor-profile">
    <?php $img = Yii::app()->baseUrl . "/webroot/monitor/faces/f" . rand(1, 3) . ".jpg"; ?>
    <?= CHtml::image($img, '', array('class' => 'autor-profile-pic')); ?>
    <div class="autor-name">
        <h3><?= $user->perfil->nome ?></h3>
    </div>
</div>
<?php if (strlen($user->perfil->apresentacao) > 0): ?>
    <blockquote><?= $user->perfil->apresentacao; ?></blockquote>
<?php endif; ?>

<?php if (count($user->topicos) > 0): ?>
    <div class="row">
        <div class="span12">
            <h3>Tópicos</h3>
            <?php foreach ($user->topicos as $t): ?>
                <?= CHtml::link($t->nome, $this->createUrl('topico/ver', array('id' => $t->id))) . '<br>'; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <h6 class="textCenter">Nenhum tópico publicado.</h6>
<?php endif; ?>
<?php if (!is_null($nodoRaiz)): ?>
    <div class="row">
        <div class="span12">
            <h3>Árvore</h3>
            <?php
            $this->widget('application.widgets.Arvore.Arvore', array(
                'raiz' => $nodoRaiz->id,
            ));
            ?>
        </div>
    </div>
<?php endif; ?>
<style>
    .autor-profile {
        background: #E8E8E8;
        text-align: right;
    }
    .autor-profile .autor-name {
        float: left;
        margin-top: 40px;
        padding-left: 12px;
    }
    .autor-profile-pic {
        border: 10px solid transparent;
        max-width: 128px;
        border-radius: 100px;
    }
    @media (max-width: 480px) {
        .autor-profile {
            text-align: center;
        }
        .autor-profile .autor-name {
            float: none;
        }
    }

</style>