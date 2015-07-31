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
			<meta property="og:title" content="O Monitor <?=isset($_GET['q']) ? ': ' . $_GET['q'] : null; ?>"/>
			<meta property="og:image" content="http://omonitor.io/dev/monitor-lite/webroot/logo-face.png"/>
			<meta property="og:site_name" content="O Monitor"/>
			<meta property="og:description" content="TODO"/>			
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
                <?php if ($this->showMainSearch): ?>

                    <div class="textCenter">
                        <?= CHtml::image(Yii::app()->baseUrl . '/webroot/logo.png', 'Logo O Monitor', array('style' => 'height: 80px;')); ?>
                    </div>

                    <form id="search-form" class="search-form clearfix" method="get" action="<?php echo $this->createUrl('search/ResultEq'); ?>" autocomplete="off">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'q',
                            'source' => Yii::app()->controller->createUrl('search/AutocompleteInstrucao'),
                            // additional javascript options for the autocomplete plugin
                            'options' => array(
                                'minLength' => '1',
                            ),
                            'htmlOptions' => array(
                                'id' => 's',
                                'autocomplete' => 'off',
                                'class' => 'search-term required',
                                'placeholder' => 'Use números, funções f(x), f(y) ou f(x,y) ou comandos da calculadora',
                            ),
                        ));
                        ?>
                        <input class="search-btn" type="submit" value="=" />
                    </form>
                    <br>
                    <div id="search-menu" class="search-form" style="width: 50%; margin: 0 auto;">
                        <a href="#" style="color:#fff;" onclick="$('#teclado-s').slideToggle();
                                return false"><?= CHtml::image(Yii::app()->baseUrl . '/webroot/monitor/images/li-key.png', 'Teclado comandos') ?></a>
                        <div id="teclado-s" style="display: none;">
                            <?php
                            $this->widget('shared.widgets.Teclado.ViewTeclado', array(
                                'inputID' => 's',
                                'tecladoID' => Teclado::Arquimedes,
                                'template' => 'template3',
                            ));
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- End of Search Wrapper -->
        <!-- Start of Page Container -->
        <?php echo $content; ?>
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
