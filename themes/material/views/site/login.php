<div class="container" style="margin-top:-49px;">
  <div class='card-panel'>
    <div class="row">
        <div class="col m1 s12">&nbsp;</div>
        <div class="col m5 s12">
          <h5>Login</h5>
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
            <?php echo CHtml::submitButton('Entrar', array('class' => 'grey darken-3 btn btn-primary right')); ?>
            <br>
            <br>
            <div class="textRight">
                <?= CHtml::link('Esqueci minha senha', '#', array('class' => '')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="col  m6 s12 center-align">
          <div class="hide-on-med-and-up divider"></div>
          <br><br><br>
          <?= CHtml::link('Cadastro usando meu email', $this->createUrl('site/cadastro'), array(
            // 'style' => 'font-size: 16px;',
            'class' => 'btn grey darken-2',
          )); ?>
          <br>
          <?= ViewHelper::getSocialLoginButtons(); ?>
          <br>
        </div>
    </div>
  </div>
</div>
