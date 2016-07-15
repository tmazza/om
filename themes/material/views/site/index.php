<?php
$query = !isset($_GET['q']) || (isset($_GET['q']) && strlen($_GET['q']) == 0) ? false : $_GET['q'];
?>
<div class="container">
  <br><br><br>
  <div style="max-width: 10600px; margin: 0 auto;">
    <div class='row' id='header-auto'>
      <div class='col m10 s9'>
        <nav class='white'>
          <div class="nav-wrapper">
            <form method="get" id='search-form' action="<?php echo $this->createUrl('site/index'); ?>">
              <div class="input-field" style="color:#000;">
                <?php
                echo CHtml::textField('q',$query,[
                        'id' => 'search',
                        'autocomplete' => 'off',
                        'required' => true,
                        'style' => 'padding-left:1rem;border:none!important;box-shadow:none!important;',
                  ]);
                ?>
              </div>
            </form>
          </div>
        </nav>

        <div class='row' style="margin-bottom: 0px;margin-top:6px;">
          <div class='col s12'>
            <div class='row'  style="margin-bottom: 0px;">
              <div class='col s2 l2'>
                <a onclick='$("#tec-btn-box-search").slideToggle();' href='#!' class="btn-flat grey lighten-3 waves-effect waves-light hoverable tooltipped" data-position='right' data-tooltip="Teclado">
                  <i style='font-size:1.7em' class="material-icons black-text">keyboard</i>
                </a>
              </div>
              <div class='col s8 l8 center-align'>
                <a class="waves-effect waves-light btn-flat" href="#como-utilizar" onclick="$('#como-usar').slideToggle();">Como usar?</a>
              </div>
              <div class='col s2 l2'>
                <a href='<?=$this->createUrl('site/aleatorio')?>' class="btn-flat grey lighten-3 right hoverable" title="Exemplo aleatório">
                  <?=CHtml::image(Yii::app()->baseUrl.'/themes/material/assets/img/media-shuffle.png','',array('style'=>'width:24px;padding-top:7px;'));?>
                </a>
              </div>
            </div>
            <?php
            $this->widget('application.widgets.Teclado.ViewTeclado', array(
                'inputID' => 'search',
                'tecladoID' => Teclado::Arquimedes,
                'template' => 'template5',
            ));
            ?>
          </div>
        </div>


      </div>
      <div class='col m1 hide-on-small-only'>&nbsp;</div>
      <div class='col s3 m1' style="padding-top:2px;">
        <a onclick="$('#search-form').submit();" class="right btn-floating btn-large waves-effect waves-light blue-grey lighten-1 ">=</a>
      </div>
    </div>
    <div id='como-usar' class='card-panel' style="display: none;text-align:justify;"><?=$comoUsar;?></div>
  </div>
  <?php if($query): ?>
    <div class='card-panel'>
      <?php
      $this->widget('application.widgets.Arquimedes.Arquimedes', array(
          'tecladoTemplate' => 'template3',
          'showSearchInput' => false,
      ));
      ?>
    </div>
  <?php endif; ?>
</div>
<div class="container" style="margin-top:80px;">
  <?=CHtml::ajaxLink('Lista completa de exemplos',$this->createUrl('/site/exemplos'),[
    'success'=>'js:function(html){
      $("#ajax-exemplos").html(html);
      MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("ajax-exemplos")]);
      $("#btn-ex").remove();
    }',
  ],[
    'id'=>'btn-ex',
  ]);?>
  <div id='ajax-exemplos'></div>
</div>

<script>
$(document).ready(function(){
  $('#search').focus();
});
$("#search").autocomplete({
  minLength: 1,
  'source':'<?=Yii::app()->controller->createUrl('/search/AutocompleteInstrucao')?>',
  'select': function(event,ui){
      window.location.assign("/app/?q="+encodeURI(ui.item.value));
  },
  'open':function(event,ui){ 
    console.log("ok");
    MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("ui-id-1")]);
    console.log("---- end ok");
  },
});
</script>