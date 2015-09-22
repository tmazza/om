<div class="container" style="margin-top:-49px;">
  <div class='card-panel'>
    <div class="row">
        <div class="col m1 s12">&nbsp;</div>
        <div class="col m5 s12">
					<h5>Cadastro</h5>
  				<?php echo $form; ?>
        </div>
        <div class="col m1 s12">&nbsp;</div>
        <div class="col m4 s12">
          <div class="hide-on-med-and-up divider"></div>
          <br><br><br>
          <div class="center-align">
            <p class='flow-text'>
              Estando logado, é possível criar e compartilhar suas próprias interações.
              <br>
            </p>
            <span class='grey-text right'>Em Sage ou Python, <br>em breve R e Singular</span>
            <?//= ViewHelper::getSocialLoginButtons(); ?>
          </div>
          <br><br><br>
          <?= CHtml::link('&laquo; Já tenho cadastrado.', $this->createUrl('site/login')); ?>
        </div>
        <div class="col m1 s12">&nbsp;</div>
    </div>
  </div>
</div>
