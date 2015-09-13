<div class="container" style="margin-top:-49px;">
  <div class='card-panel'>
    <div class="row">
        <div class="col m1 s12">&nbsp;</div>
        <div class="col m5 s12">
					<h5>Utilizar meu email</h5>
  				<?php echo $form; ?>
        </div>
        <div class="col m1 s12">&nbsp;</div>
        <div class="col m5 s12">
          <div class="hide-on-med-and-up divider"></div>
          <br><br><br>
          <div class="center-align">
            <?= ViewHelper::getSocialLoginButtons(); ?>
          </div>
          <br><br><br>
          <?= CHtml::link('&laquo; Já tenho cadastrado.', $this->createUrl('site/login')); ?>
        </div>
    </div>
  </div>
</div>
