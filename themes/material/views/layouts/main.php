<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>O Monitor</title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/webroot/monitor/images/favicon.png?v=2" />
        <!-- Google icon fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
        <!-- <link rel='stylesheet' href='<?php //echo Yii::app()->baseUrl ?>/webroot/monitor/css/camada.css' type='text/css' media='all' /> -->

		<?php if($this->faceData): ?>
			<!-- Facebook -->
			<meta property="og:title" content="<?=isset($_GET['q']) ?  $_GET['q'] : null; ?>"/>
			<meta property="og:image" content="http://omonitor.io/dev/monitor-lite/webroot/logo-face3.png"/>
			<meta property="og:site_name" content="O Monitor"/>
			<meta property="og:description" content="Calcule problemas matemáticos em diversas áreas: ... - O Monitor"/>
		<?php endif; ?>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src='<?php echo Yii::app()->baseUrl ?>/webroot/monitor/js/html5.js'></script>
        <![endif]-->
    </head>

    <body class='grey lighten-3'>
      <div class='row' style='border-bottom: 2px solid #616161;'>
        <div class='blue-grey darken-1 col s12' style='height:150px;'>
          <div class="container">
            <br>
            <a href='<?=Yii::app()->baseUrl;?>'>
              <img src='http://omonitor.io/webroot/logo.png' height="45px;" />
            </a>
            <div class='right'>
              <?php if (Yii::app()->user->isGuest): ?>
                <a href='<?=$this->createUrl('site/login')?>' class="white-text">
                  <b class="hide-on-small-only">Cadastre-se / Login</b>
                  <b class="hide-on-med-and-up">Entrar</b>
                </a>
              <?php else: ?>
                <a href='<?=$this->createUrl('meuEspaco/default/index');?>' class="white-text">
                  <b><?=Yii::app()->user->nome;?></b>
                </a>
                &nbsp; <?=CHtml::link('(Sair)',$this->createUrl('site/logout'),array('class'=>'grey-text'));?>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
      <div class='row'>
        <div class='col s12'>
          <?=$content;?>
        </div>
      </div>
    </body>

</html>
<style>
  .hide {
    display: none;
  }
</style>
<script>
$(document).ready(function(){
  $('.modal-trigger').leanModal();
});
</script>
