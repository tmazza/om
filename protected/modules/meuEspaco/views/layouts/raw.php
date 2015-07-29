<?php $basePath = Yii::app()->assetManager->publish(Yii::getPathOfAlias('meuEspaco.assets')); ?>
<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <title><?= Yii::app()->name; ?> | <?= strlen($this->pageTitle) <= 0 ? ($this->id . ' ' . $this->action->id) : $this->pageTitle; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!--Bootstrap 3.3.2--> 
        <link href="<?= $basePath; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
        <!--FontAwesome 4.3.0--> 
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!--Ionicons 2.0.0--> 
        <link href="<?= $basePath; ?>/fonts/ionicons.min.css" rel="stylesheet" type="text/css" />    
        <!--Theme style--> 
        <link href="<?= $basePath; ?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!--         AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link href="<?= $basePath; ?>/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!--iCheck--> 
        <link href="<?= $basePath; ?>/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <!--Morris chart--> 
        <link href="<?= $basePath; ?>/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!--jvectormap--> 
        <link href="<?= $basePath; ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!--Date Picker--> 
        <link href="<?= $basePath; ?>/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!--Daterange picker--> 
        <link href="<?= $basePath; ?>/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!--bootstrap wysihtml5 - text editor--> 
        <link href="<?= $basePath; ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <?php
    $skinColor = 'blue';
    if (Yii::app()->user->perfil == 'autor') {
        $skinColor = 'purple';
    } elseif (Yii::app()->user->perfil == 'admin') {
        $skinColor = 'green';
    }
    ?>
    <body class="skin-<?= $skinColor ?>">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?= $this->createUrl('/site/index') ?>" class="logo"><?= Yii::app()->user->orgName ?></a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <?php $msgNaoLidas = ShMsg::getNaoLidas(); ?>
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <?php if (count($msgNaoLidas) > 0): ?>
                                        <span class="label label-success"><?= count($msgNaoLidas); ?></span>
                                    <?php endif; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Você tem <?= count($msgNaoLidas) ?> não lida<?= ShMsg::hasPlural(count($msgNaoLidas)); ?>.</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <?php foreach ($msgNaoLidas as $m): ?>
                                                <li><!-- start message -->
                                                    <a href="<?= ShCode::getModUrl('mensagem', 'ler', 'index', array('id' => $m->id)) ?>">
                                                        <div class="pull-left">
                                                            <img src="<?= $basePath; ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                                        </div>
                                                        <h4>
                                                            <?= $m->origem->perfil->nome; ?>
                                                            <small><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?= ShMsg::tempoAteAgora($m->dataEnvio); ?></small>
                                                        </h4>
                                                        <?php $msg = strip_tags($m->mensagem, '<br>'); ?>
                                                        <p><?= substr($msg, 0, 30) . (strlen($msg) > 30 ? '...' : ''); ?></p>
                                                    </a>
                                                </li><!-- end message -->
                                            <?php endforeach; ?>
                                            <?php $ultimasMensagens = ShMsg::ultimasRecebidas(10 - count($msgNaoLidas)); ?>
                                            <li class="header text-center">Últimas mensagens</li>
                                            <?php foreach ($ultimasMensagens as $m): ?>
                                                <li><!-- start message -->
                                                    <a href="<?= ShCode::getModUrl('mensagem', 'ler', 'index', array('id' => $m->id)) ?>">
                                                        <div class="pull-left">
                                                            <img src="<?= $basePath; ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                                        </div>
                                                        <h4>
                                                            <?= $m->origem->perfil->nome; ?>
                                                            <small><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?= ShMsg::tempoAteAgora($m->dataEnvio); ?></small>
                                                        </h4>
                                                        <?php $msg = strip_tags($m->mensagem, '<br>'); ?>
                                                        <p><?= substr($msg, 0, 30) . (strlen($msg) > 30 ? '...' : ''); ?></p>
                                                    </a>
                                                </li><!-- end message -->
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="<?= ShCode::getModUrl('mensagem', 'ler', 'listar') ?>">Ver todas as mensagens</a></li>
                                </ul>
                            </li>
                            <!--
                            <!-- Notifications: style can be found in dropdown.less 
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-user text-red"></i> You changed your username
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                            Tasks: style can be found in dropdown.less 
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 9 tasks</li>
                                    <li>
                            <!-- inner menu: contains the actual data 
                            <ul class="menu">
                                <li><!-- Task item 
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item 
                                <li><!-- Task item 
                                    <a href="#">
                                        <h3>
                                            Create a nice theme
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item
                                <li><!-- Task item 
                                    <a href="#">
                                        <h3>
                                            Some task I need to do
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item 
                                <li><!-- Task item 
                                    <a href="#">
                                        <h3>
                                            Make beautiful transitions
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item 
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= $basePath; ?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs"><?= Yii::app()->user->nome; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?= $basePath; ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                        <p>
                                            <?= Yii::app()->user->nome; ?>  
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">-</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">-</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">-</a>
                                        </div>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= ShCode::getModUrl('edicaoPerfil') ?>" class="btn btn-default btn-flat">Meu perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= $this->createUrl('/site/logout') ?>" class="btn btn-default btn-flat">Sair</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?= $basePath; ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>
                                <a href="<?= $this->createUrl('/meuEspaco/default/index') ?>">
                                    <?= Yii::app()->user->nome; ?>
                                </a>
                            </p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Cursos, materiais, etc..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <?php
                    $this->widget('meuEspaco.widgets.MainMenuMeuEspaco.MainMenuMeuEspaco', array(
                        'menu' => $this->menu,
                    ));
                    ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!--Flash msg-->
                <section class="content-header">
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                        'homeLink' => false,
                        'tagName' => 'ol',
                        'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
                        'inactiveLinkTemplate' => '<li>{label}</li>',
                        'separator' => null,
                        'htmlOptions' => array(
                            'class' => 'breadcrumb',
                        ),
                    ));
                    ?>
                    <br><br>
                </section>

                <?php if ($this->showSolver): ?>
                    <section class="content-header">
                        <div class="sh-row" id="openMath">
                            <div class="column medium-2">
                                <input id="mathSolver-term" class="form-control" />
                            </div>
                            <div class="column medium-1">
                                <?php $img = CHtml::image($this->assetsPath . '/img/sage-b.png'); ?>
                                <?php
                                echo CHtml::ajaxLink($img, $this->createUrl('loadMathSolver'), array(
                                    'beforeSend' => 'js: function() {'
                                    . '$("#mathSolver").html("<i class=\'fa fa-refresh fa-spin\'></i>").dialog("open");'
                                    . '}',
                                    'data' => array('q' => 'js: $("#mathSolver-term").val() '),
                                    'success' => 'js: function(html) {'
                                    . '$("#mathSolver").html(html);'
                                    . 'MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("mathSolver")]);'
                                    . '}',
                                        ), array(
                                    'class' => 'btn btn-primary',
                                    'id' => 'load-math-solver',
                                ));
                                ?>
                            </div>
                            <div class="medium-offset-9"></div>
                        </div>
                    </section>
                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'mathSolver',
                        'options' => array(
                            'title' => '',
                            'autoOpen' => false,
                            'minWidth' => 900,
                            'minHeight' => 400,
                            'modal' => true,
                            'draggable' => false,
                            'overlay' => array(
                                'backgroundColor' => '#000',
                                'opacity' => '0.5'
                            ),
                        ),
                        'htmlOptions' => array(),
                    ));
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    ?>
                <?php endif; ?>

                <!--TODO: verificar usabilidade disto-->
                <?php if (count($this->menuContexto) > 0): ?>
                    <section class="content-header context-search">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                        <span class="sr-only">Abre-fecha menu</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <!--<a class="navbar-brand" href="#"><?//= Yii::app()->controller->module->id; ?></a>-->
                                </div>
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <?php
                                    $this->widget('zii.widgets.CMenu', array(
                                        'encodeLabel' => true,
                                        'items' => $this->menuContexto,
                                        'htmlOptions' => array(
                                            'class' => 'nav navbar-nav',
                                        ),
                                    ));
                                    ?>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </section>
                <?php endif; ?>
                <?php if (count(Yii::app()->user->getFlashes(false)) > 0): ?>
                    <section class="content-header">
                        <?php echo ShCode::renderFlashes(); ?>
                    </section>
                <?php endif; ?>
                <?= $content; ?>
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <!--<b>Version</b> 2.0-->
                </div>
                <strong>OMonitor</strong>
            </footer>
        </div><!-- ./wrapper -->
        <style>
            .ui-corner-all {
                border-radius: 0px;
            }
            .ui-widget-header {
                background: #3C8DBC;
                color: white;
            }
            .ui-dialog {
                z-index: 1000000!important;
            }
        </style>
        <!--jQuery UI 1.11.2--> 
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <!--Resolve conflict in jQuery UI tooltip with Bootstrap tooltip--> 
        <script>
//            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!--Bootstrap 3.3.2 JS--> 
        <script src="<?= $basePath; ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <!--Morris.js charts--> 
       <!--<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
        <script src="<?= $basePath; ?>/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!--Sparkline--> 
        <script src="<?= $basePath; ?>/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!--jvectormap--> 
        <script src="<?= $basePath; ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?= $basePath; ?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!--jQuery Knob Chart--> 
        <script src="<?= $basePath; ?>/plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <!--daterangepicker--> 
        <script src="<?= $basePath; ?>/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!--datepicker--> 
        <script src="<?= $basePath; ?>/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!--Bootstrap WYSIHTML5--> 
        <script src="<?= $basePath; ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!--iCheck--> 
        <script src="<?= $basePath; ?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!--Slimscroll--> 
        <script src="<?= $basePath; ?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!--AdminLTE App--> 
        <script src="<?= $basePath; ?>/dist/js/app.min.js" type="text/javascript"></script>
    </body>
</html>