<div id="arq-content" class="uk-form">
	<?php
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name' => $this->term,
        'source' => Yii::app()->controller->createUrl('AutocompleteInstrucao'),
        'value' => $this->query,
        'options' => array(
            'minLength' => '1',
            'appendTo'=>'#arq-content'
        ),
        'htmlOptions' => array(
            'id' => 'arq-main-input',
            'autocomplete' => 'off',
            'z-index'=>'100',
						'autofocus'=>'',
            'class'=>'uk-width-1-3',
            'placeholder'=>'Digite um expressão matemática'
        ),
    ));

    if (isset($this->ajaxUrl)) {
        echo CHtml::ajaxLink('=', $this->ajaxUrl, array(
              'beforeSend' => 'js: function() {
                $("' . $this->ajaxUpdate . '").html("<div class=\'uk-modal-spinner\'></div>");
              }',
              'success' => 'js: function(html) {
                $("' . $this->ajaxUpdate . '").html(html);
                MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("mathSolver")]);
              }',
              'data' => array($this->term => 'js: $("#arq-main-input").val()')
            ), array(
            'class' => 'uk-button uk-button-primary',
            'id' => 'arq-submit-button' . hash('md5', microtime(true)),
        ));
        Yii::app()->clientScript->registerScript('sagecell-autoload2', 'sagecell.makeSagecell({inputLocation: " .sage-auto",autoeval: true,evalButtonText: "Resolver",hide:["editor","language","evalButton","permalink","done","sessionFiles"]});');
    }
    ?>

    <!-- TECLADO -->
    <a onclick='$(this).next().slideToggle();' href='#!' class="uk-button" data-delay='0' data-position='right' data-tooltip="Teclado">
      <i class='uk-icon uk-icon-keyboard-o'></i> Teclado
    </a>

    <div style="display:none;">
      <?php
      $this->widget('shared.widgets.Teclado.ViewTeclado', array(
          'inputID' => 'arq-main-input',
          'tecladoID' => Teclado::Arquimedes,
          'template' => 'template2',
      ));
      ?>
    </div>
    <!-- FIM-TECLADO -->

    <!-- <button class="uk-button" data-uk-modal="{target:'#e-modal-l2'}">HELP!</button> -->


    <?php if (strlen($this->query) > 0): ?>
        <div id="arq-code">
            <?php
            $this->render($view, array(
								'code' => $code,
            ));
            ?>
        </div>
    <?php endif; ?>

</div>
