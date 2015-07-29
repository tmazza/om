<section class="widget" style="margin: 0 auto; min-width: 300px; max-width: 400px;">
    <div class="quick-links-widget textCenter">
        <div class="row">
            <h4>Cadastre-se</h4>
        </div>
        <?php
        echo $form;
        ?>
    </div>
</section>
<br>
<section class="widget" style="margin: 0 auto; min-width: 300px; max-width: 400px;">
    <div class="quick-links-widget textCenter">
        <?= CHtml::link('&laquo; Já tenho cadastrado.', $this->createUrl('site/login')); ?>
    </div>
</section>
