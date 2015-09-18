<?php $this->beginContent(); ?>
<div class="container" style="margin-top:-49px;">
  <nav class="blue-grey lighten-1 ">
     <div class="nav-wrapper">
       <a href="<?=$this->createUrl('/home/default/index')?>" class="brand-logo flow-text">
         &nbsp;&nbsp;<?=Yii::app()->user->nome;?>
       </a>
       <a href="#" data-activates="user-menu" class="button-collapse"><i class="material-icons">menu</i></a>
       <ul class="right hide-on-med-and-down">
         <li><a href="<?=$this->createUrl('/home/interacao/')?>"><i class="material-icons right">code</i>Minhas interações</a></li>
         <li><a href="<?=$this->createUrl('/site/logout/')?>"><i class="material-icons right"></i>Sair</a></li>
         <!-- <li><a href="<?//=$this->createUrl('/meuEspaco/mensagem/')?>">Mensagens<i class="material-icons right">email</i></a></li> -->
       </ul>
       <ul class="side-nav" id="user-menu">
         <li><a href="<?=$this->createUrl('/home/interacao/')?>"><i class="material-icons left">code</i>Minhas interações</a></li>
         <!-- <li><a href="<?//=$this->createUrl('/meuEspaco/mensagem/')?>">Mensagens<i class="material-icons left">email</i></a></li> -->
       </ul>
     </div>
   </nav>
   <?=$content;?>
 </div>
<?php $this->endContent(); ?>
