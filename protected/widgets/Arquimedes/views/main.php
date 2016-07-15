<?php
if($this->instructionOn){
	echo CHtml::link(ucfirst($this->instructionOn->descricao),Yii::app()->controller->createUrl('/instrucoes/ver',array(
        'id'=>$this->instructionOn->id,
        'nome'=>$this->instructionOn->descricao,
        )));
}
?>
<div id="arq-content">
	<?php if(isset($this->historico) && $this->historico): ?>
		<div class="s-hist"></div>
	<?php endif; ?>

	<?php if($this->showSearchInput): ?>
	<?php
    if (isset($this->ajaxUrl)) {

    } else {
        echo CHtml::beginForm(Yii::app()->controller->createUrl($this->action), 'GET');
    }
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name' => $this->term,
        'source' => Yii::app()->controller->createUrl('AutocompleteInstrucao'),
        'value' => $this->query,
        // additional javascript options for the autocomplete plugin
        'options' => array(
            'minLength' => '1',
        ),
        'htmlOptions' => array(
            'id' => 'arq-main-input',
            'autocomplete' => 'off',
        ),
    ));

    if (isset($this->ajaxUrl)) {

//            'success' => 'js: function(html) {'
//            . '$("#' . $this->ajaxUpdate . '").html(html);'
//            . '}',

        echo CHtml::ajaxLink('=', $this->ajaxUrl, array(
            'beforeSend' => 'js: function() {'
            . '$("' . $this->ajaxUpdate . '").html("<i class=\'fa fa-refresh fa-spin\'></i>").dialog("open");'
            . '}',
            'success' => 'js: function(html) {'
            . '$("' . $this->ajaxUpdate . '").html(html);'
            . 'MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("mathSolver")]);'
            . '}',
            'update' => $this->ajaxUpdate,
            'data' => array($this->term => 'js: $("#arq-main-input").val()')
                ), array(
//            'type' => 'button',
            'class' => 'arq-submit-button',
            'id' => 'arq-submit-button' . hash('md5', microtime(true)),
        ));
        Yii::app()->clientScript->registerScript('sagecell-autoload2', 'sagecell.makeSagecell({inputLocation: " .sage-auto",autoeval: true,evalButtonText: "Resolver",hide:["editor","language","evalButton","permalink","done","sessionFiles"]});');
    } else {
        echo CHtml::submitButton('=', array(
            'class' => 'arq-submit-button',
            'id' => 'arq-submit-button',
        ));
        echo CHtml::endForm();
    }
    echo CHtml::image(Yii::app()->baseUrl . '/webroot/monitor/images/li-key-b.png', 'Teclado comandos', array(
        'onClick' => '$("#arq-teclado").slideToggle();',
        'style' => 'cursor: pointer; float: left;',
    ));
    echo '<br>';
    ?>


    <div id="arq-teclado" style="display: none; color: #6F7579;">
        <?php
        $this->widget('shared.widgets.Teclado.ViewTeclado', array(
            'inputID' => 'arq-main-input',
            'tecladoID' => Teclado::Arquimedes,
            'template' => $this->tecladoTemplate,
        ));
        ?>
    </div>
	<?php endif; ?>


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
<script>
if(typeof(Storage) !== "undefined") {
	if(localStorage.hist){
		hist = JSON.parse(localStorage["hist"]);
	} else {
		hist = [];
	}

	hist.push(decodeURIComponent(window.location.href));

	if(hist.length > 10) {
		hist.shift();
	}

	localStorage["hist"] = JSON.stringify(hist);


	function getSearchParameters(url) {
		  var data = url.split('?')
		  var prmstr = data[1];
		  return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
	}

	function transformToAssocArray( prmstr ) {
		var params = {};
		var prmarr = prmstr.split("&");
		for ( var i = 0; i < prmarr.length; i++) {
			var tmparr = prmarr[i].split("=");
			params[tmparr[0]] = tmparr[1];
		}
		return params;
	}

	while(hist.length > 0){
		url = hist.pop();
		params = getSearchParameters(decodeURI(url));
		label = decodeURI(params.q);
		$('.s-hist').append("<a class='card' href='" + url + "'>" + (label) + "</a>");
	}

}
</script>
