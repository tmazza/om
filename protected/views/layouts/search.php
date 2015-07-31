<!DOCTYPE html>
<html lang="pt-BR">
    <!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="pt-BR"> <![endif]-->
    <!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="pt-BR"> <![endif]-->
    <!--[if IE 8]>    <html class="lt-ie9" lang="pt-BR"> <![endif]-->
    <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>O Monitor</title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/webroot/monitor/images/favicon.png?v=2" />


        <!-- Google Web Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

        <!-- Style Sheet-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/webroot/monitor/style.css"/>
        <link rel='stylesheet' href='<?php echo Yii::app()->baseUrl ?>/webroot/monitor/css/bootstrap.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' href='<?php echo Yii::app()->baseUrl ?>/webroot/monitor/css/responsive.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' href='<?php echo Yii::app()->baseUrl ?>/webroot/monitor/js/prettyphoto/prettyPhoto.css?ver=3.1.4' type='text/css' media='all' />
        <link rel='stylesheet' href='<?php echo Yii::app()->baseUrl ?>/webroot/monitor/css/main.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' href='<?php echo Yii::app()->baseUrl ?>/webroot/monitor/css/camada.css' type='text/css' media='all' />

		<?php if($this->faceData): ?>
			<!-- Facebook -->
			<meta property="og:title" content="<?=isset($_GET['q']) ? $_GET['q'] : null; ?>"/>
			<meta property="og:image" content="http://omonitor.io/dev/monitor-lite/webroot/logo-face3.png"/>
			<meta property="og:site_name" content="O Monitor"/>
			<meta property="og:description" content="Calcule problemas matemáticos em diversas áreas: ... - O Monitor"/>			
		<?php endif; ?>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src='<?php echo Yii::app()->baseUrl ?>/webroot/monitor/js/html5.js'></script>
        <![endif]-->
    </head>

    <body>
        <!-- Start of Header -->
        <div class="header-wrapper">
            <header>
                <div class="container">
                    <?php if (!$this->showMainSearch): ?>
                        <div class="logo-container" style="" >
                            <a href="<?= Yii::app()->baseUrl . '/'; ?>">
                                <?= CHtml::image(Yii::app()->baseUrl . '/webroot/logo.png', 'Logo O Monitor', array('style' => 'height: 40px;')); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <!-- Start of Main Navigation -->
                    <nav class="main-nav">
                        <div class="menu-top-menu-container">
                            <?php
                            if (!Yii::app()->user->isGuest) {
                                $perfil = Yii::app()->user->perfil;
                                $usuario = "<li>" . CHtml::link('<b>' . Yii::app()->user->nome . '</b>', $this->createUrl('meuEspaco/default/index')) . "</li>";
                                $acesso = CHtml::link("(Sair)", $this->createUrl('site/logout'));
                            } else {
                                $usuario = "";
                                $acesso = CHtml::link("Login", $this->createUrl('site/login'), array('class' => 'link-login'));
                            }
                            ?>

                            <ul id="menu-top-menu" class="clearfix">
                                <?= $usuario ?>
                                <li><?= $acesso ?></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- End of Main Navigation -->

                </div>
            </header>
        </div>
        <!-- End of Header -->

        <!-- Start of Search Wrapper -->
        <div class="search-area-wrapper">
            <div class="search-area container">
            </div>
        </div>
        <!-- End of Search Wrapper -->
        <div class="container">
				<div class="row">	
					<div class="span3" id='s-menu'>
						<br><br><br>
						<?php
						$items = ExemplosSearchCategoria::model()->findAll(array('order'=>'ordem'));
						echo '<ul>';
						foreach($items as $i){
							echo CHtml::tag('li',array(),CHtml::ajaxLink($i->nome, $this->createUrl('search/exemplos', array('c'=>$i->id)),array(
								'beforeSenf' => 'js: function() { $("#s-ex").html("..."); }',
								'success' => 'js: function(html) {
									$("#s-ex").hide(0).html(html).fadeIn(300);			
									MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("s-ex")]);			
								}',
							),array('id' => 'load-s-ex'.$i->id,)));
						}
						echo '</ul>';						
						?>
						<br><br>
						<div class="s-hist"></div>
						<br><br>

					</div>

				
					<div class="span9">
						<br>
						<div id="s-mini-hist">
							<button type="button" class="btn btn-mini btn-card" onclick="$('#mini-hist').slideToggle();" >Histórico</button>
							<div id="mini-hist" style="display: none;">
								<div class="s-hist"></div>
							</div>
						</div>
						<div id="s-ex"></div>
						<?php echo $content; ?>
						<div id="s-save" class="textCenter">
							<?php $this->renderPartial('/search/_saveSearch', array('q' => isset($_GET['q']) ? $_GET['q'] : null)); ?>
						</div><br><br>
					</div>        
				</div>
		</div>
        <!-- Start of Page Container -->
        
        <!-- End of Page Container -->


        <footer id="footer-wrapper">
            <?php if ($this->showArvoreConteudo): ?>
                <div class="container">
                    <?php
                    $cs = Yii::app()->clientScript;
                    $cs->registerScriptFile(Yii::app()->baseUrl . '/webroot/autor/plugin-d3/js/d3.js');
                    $cs->registerScriptFile(Yii::app()->baseUrl . '/webroot/autor/plugin-d3/js/d3-la.js');
                    $this->renderPartial('//arvore/ver4');
                    ?>
                    <br><br>
                </div>
            <?php endif; ?>

            <!-- Start of Footer -->
            <div id="footer" class="container">
                <div class="row">

                    <div class="span3">
                        <section class="widget">
                            <h3 class="title">Sobre</h3>
                            <ul>
                                <li><?= CHtml::link('Apresentação', $this->createUrl('sobre/apresentacao')); ?></li>
                                <li><?= CHtml::link('Modo de Usar', $this->createUrl('sobre/modoDeusar')); ?></li>
                                <li><?= CHtml::link('Plataformas', $this->createUrl('sobre/plataformas')); ?></li>
                                <li><?= CHtml::link('Referências', $this->createUrl('sobre/referencias')); ?></li>
                                <li><?= CHtml::link('Parceiros', $this->createUrl('sobre/parceiros')); ?></li>
                            </ul>
                        </section>
                    </div>
                    <div class="span3">
                        <section class="widget">
                            <!--<h3 class="title"><?//= CHtml::link(CHtml::image(Yii::app()->baseUrl . '/webroot/monitor/images/tflow.png') . ' Árvore de conteúdo', $this->createUrl('arvore/ver4')) ?></h3>-->
                        </section>
                    </div>

                    <div class="span3">
                        <?php
//                        $this->widget('application.widgets.MenuListaTopicos.MenuListaTopicos', array(
//                            'title' => $this->titleMenuContexto,
//                            'items' => $this->menuContexto,
//                        ));
                        ?>
                    </div>


                    <div class="span3">

                        <section class="widget">
                        </section>

                    </div>

                </div>
            </div>
            <!-- end of #footer -->

            <!-- Footer Bottom -->
            <div id="footer-bottom-wrapper">
                <div id="footer-bottom" class="container">
                    <div class="row">
                        <div class="span6">
                            <p class="copyright">
                                O Monitor 2015 Copyright © Todos os Direitos Reservados.
                            </p>
                        </div>
                        <div class="span6">
                            <!-- Social Navigation -->
                            <!--                            <ul class="social-nav clearfix">
                                                            <li class="linkedin"><a target="_blank" href="#"></a></li>
                                                            <li class="stumble"><a target="_blank" href="#"></a></li>
                                                            <li class="google"><a target="_blank" href="#"></a></li>
                                                            <li class="deviantart"><a target="_blank" href="#"></a></li>
                                                            <li class="flickr"><a target="_blank" href="#"></a></li>
                                                            <li class="skype"><a target="_blank" href="skype:#?call"></a></li>
                                                            <li class="rss"><a target="_blank" href="#"></a></li>
                                                            <li class="twitter"><a target="_blank" href="#"></a></li>
                                                            <li class="facebook"><a target="_blank" href="#"></a></li>
                                                        </ul>-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Footer Bottom -->

        </footer>     

        <!-- End of Footer -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/webroot/monitor/js/main.js" type="text/javascript"></script>
    </body>
</html>
