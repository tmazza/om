<?php
echo '<ul class="nav">';
foreach($items as $i){
  if(!isset($margem)){
    $margem = "0px;";
  }
  echo CHtml::tag('li',array(),CHtml::ajaxLink($i->nome, $this->createUrl('search/exemplos', array('c'=>$i->id,'style'=>"margin-left:$margem")),array(
    'beforeSenf' => 'js: function() { $("#s-ex").html("..."); }',
    'success' => 'js: function(html) {
      $("#s-ex").hide(0).html(html).fadeIn(300);
      MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("s-ex")]);
    }',
  ),array('id' => 'load-s-ex'.$i->id,)));
  if(count($i->filhas)>0){
    echo '<li>';
    $this->renderPartial('menuExemplos',array('items'=>$i->filhas,"margem"=>"5px;"));
    echo '</li>';
  }
}
echo '</ul>';
