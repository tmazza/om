<!DOCTYPE html>
<html lang="pt-BR" class="blue-grey darken-1"> 
    <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?=$this->descricao?>">
        <meta name="keywords" content="resolver,matemática,função,plotar,corrigir,o monitor,monitor,OM,equação,sage,sagemath,solução,algebra,geometria,diferenciais">
        <meta name="author" content="O Monitor">
        <title><?=$this->pageTitle;?></title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/webroot/monitor/images/favicon.png?v=2" />
        <!-- Google icon fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
        <!-- Compiled and minified JavaScript -->
        <link rel='stylesheet' href='<?= Yii::app()->baseUrl ?>/themes/material/assets/css/main.css' type='text/css' media='all' />

		<?php if($this->faceData): ?>
			<meta property="og:title" content="<?=isset($_GET['q']) ?  $_GET['q'] : null; ?>"/>
			<meta property="og:image" content="http://omonitor.io/webroot/logo-face3.png"/>
			<meta property="og:site_name" content="<?=$this->pageTitle;?>"/>
			<meta property="og:description" content="<?=$this->descricao?>"/>
		<?php endif; ?>
    </head>

    <body class='grey lighten-3'>

    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    //
    ga('create', 'UA-67685098-1', 'auto');
    ga('send', 'pageview');
    </script>

      <nav class='blue-grey darken-1'>
        <div class="container">
         <div class="nav-wrapper">
           <?php
           $img = CHtml::image(Yii::app()->baseUrl.'/webroot/logo2.png','O Monitor',[
             'style'=>'height:25px;margin-top:15px;margin-left:8px;',
           ]);
           echo CHtml::link($img,$this->createUrl('/site/index'),[
             'class'=>'',
             'style'=>'margin-top:20px',
           ]);
           ?>
           <ul class="right">
             <li><a href="<?=$this->createUrl('/instrucoes/index')?>">Instruções</a></li>
             <li><a href="<?=$this->createUrl('/sobre/apresentacao')?>">Sobre</a></li>
           </ul>
         </div>
       </div>
     </nav>
      <!-- header -->
      <div class='row' style='border-bottom: 1px solid #616161;'>
      </div>
      <!-- fim header -->


      <!-- content -->
      <div class='row'>
        <div class='col s12'>
          <?=$content;?>
        </div>
      </div>
      <!-- fim content -->
      <br><br><br>
      <!-- footer -->
      <div class='row' style='border-top: 2px solid #616161;margin-bottom:0px;'>
        <div class='blue-grey darken-1 col s12' style='min-height:100px;'>
          <div class="container">

            <div class='row'>
              <div class='col s6 m4' style="font-size:14px;">
                  <br>
                  <?= CHtml::link('Apresentação', $this->createUrl('sobre/apresentacao'),array('class'=>'white-text')); ?><br>
                  <br>
                  <?= CHtml::link('Modo de Usar', $this->createUrl('sobre/modoDeusar'),array('class'=>'white-text')); ?><br>
                  <br>
                  <?= CHtml::link('Plataformas', $this->createUrl('sobre/plataformas'),array('class'=>'white-text')); ?><br>
                  <br>
                  <?= CHtml::link('Referências', $this->createUrl('sobre/referencias'),array('class'=>'white-text')); ?><br>
                  <br>
                  <?= CHtml::link('Primeiras Impressões', $this->createUrl('sobre/comentarios'),array('class'=>'white-text')); ?><br>
                  <br>
                  <!-- <?//= CHtml::link('Parceiros', $this->createUrl('sobre/parceiros'),array('class'=>'white-text')); ?> -->
                  <!-- <div class='divider grey'></div> -->
                  <!-- <br> -->
              </div>
              <div class='s6 m8 right-align white-text'>
                <br><br><Br>
                  Dúvidas ou sugestões?
                  Email para: <br>
                <a class='white-text' href='mailto:contato@omonitor.io'>contato@omonitor.io</a>
              </div>
            </div>
            <br><br>
            <div class="row">
              <div class="col s12">
                <a class='left' style="margin-right: 5px;" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Licença Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
                <a xmlns:cc="http://creativecommons.org/ns#" href="http://omonitor.io" property="cc:attributionName" rel="cc:attributionURL">omonitor.io</a> está licenciado com uma Licença <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons - Atribuição-NãoComercial-CompartilhaIgual 4.0 Internacional</a>.
              </div>
            </div>

          </div>
        </div>
      </div>
    </body>

</html>
<style>
  .hide {
    display: none;
  }
</style>
