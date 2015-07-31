<div class="row">
    <div class="span1"></div>
    <div class="span5">
        <section class="widget" style="margin: 0 auto; min-width: 300px; max-width: 400px;">
			<div class="quick-links-widget textCenter">
				<div class="row">
					<h4>Utilizar meu email</h4>
				</div>
				<?php echo $form; ?>
			</div>
		</section>
    </div>
    <div class="span5">
        <section class="widget" style="margin: 0 auto; min-width: 300px; max-width: 400px;">
            <div class="quick-links-widget textCenter">
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


<br>
<section class="widget" style="margin: 0 auto; min-width: 300px; max-width: 400px;">
    <div class="quick-links-widget textCenter">
        <?= CHtml::link('&laquo; Já tenho cadastrado.', $this->createUrl('site/login')); ?>
    </div>
</section>
