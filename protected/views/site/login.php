<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Identifique-se',
);
?>

<div class="row">
    <div class="span1"></div>
    <div class="span5">
        <section class="widget" style="margin: 0 auto; min-width: 300px; max-width: 400px;">
            <div class="quick-links-widget textCenter">
                <h4>Acesso ao Studio</h4>
                <br>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
                ?>
                <?php echo $form->labelEx($model, 'username'); ?>
                <?php echo $form->textField($model, 'username'); ?>
                <?php echo $form->error($model, 'username'); ?>
                <br>
                <?php echo $form->labelEx($model, 'password'); ?>
                <?php echo $form->passwordField($model, 'password'); ?>
                <?php echo $form->error($model, 'password'); ?>
                <br>
                <br>
                <?php echo CHtml::submitButton('Entrar', array('class' => 'btn btn-primary')); ?>
                <br>
                <br>
                <div class="textRight">
                    <?= CHtml::link('Esqueci minha senha', '#', array('class' => 'right')); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </section>
    </div>
    <div class="span5">
        <section class="widget" style="margin: 0 auto; min-width: 300px; max-width: 400px;">
            <div class="quick-links-widget textCenter">
                <h4>Não tenho cadastro</h4>
                <?= CHtml::link('Cadastro usando meu email', $this->createUrl('site/cadastro'), array('style' => 'font-size: 16px;')); ?>
                <br>
                <section class="widget" style="margin: 0 auto; margin-top: 20px; min-width: 300px; max-width: 400px;">
                    <div class="">
                        <?= ViewHelper::getSocialLoginButtons(); ?>
                    </div>
                </section>
                <br>
            </div>
        </section>
    </div>
    <div class="span1"></div>
</div>
