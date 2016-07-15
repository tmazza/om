<?php
$query = !isset($_GET['q']) || (isset($_GET['q']) && strlen($_GET['q']) == 0) ? false : $_GET['q'];
?>
<div class="container">
  <br><br><br>
  <div style="max-width: 600px; margin: 0 auto;">
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
      </div>
      <div class='col m1 hide-on-small-only'>&nbsp;</div>
      <div class='col s3 m1' style="padding-top:6px;">
        <a onclick="$('#search-form').submit();" class="right btn-floating btn-large waves-effect waves-light blue-grey lighten-1 ">=</a>
      </div>
    </div>
    <div class='row' style="margin-bottom: 0px;">
      <div class='col s12'>
        <?php if(!$query): ?>
          <div class='row hide-on-large-only '  style="margin-bottom: 0px;">
            <div class='col s12 center-align'>
              <a class="waves-effect waves-light btn-flat modal-trigger" href="#como-utilizar">Como utilizar</a>
            </div>
          </div>
        <?php endif; ?>
        <div class='row'  style="margin-bottom: 0px;">
          <div class='col s6 l2'>
            <a onclick='$("#tec-btn-box-search").slideToggle();' href='#!' class="btn-flat grey lighten-3 waves-effect waves-light hoverable tooltipped" data-position='right' data-tooltip="Teclado">
              <i style='font-size:1.7em' class="material-icons black-text">keyboard</i>
            </a>
          </div>
          <div class='col s12 l8 hide-on-med-and-down center-align'>
            <a class="waves-effect waves-light btn-flat modal-trigger" href="#como-utilizar">Como utilizar</a>
          </div>
          <div class='col s6 l2'>
            <a href='<?=$this->createUrl('site/aleatorio')?>' class="btn-flat grey lighten-3 right waves-effect waves-light hoverable tooltipped" data-position='left' data-tooltip="Exemplo aleatório">
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
  <br><br><br>
  <br><br><br>
<div class="container">
  <?=CHtml::ajaxLink('Lista completa de exemplos',$this->createUrl('/site/exemplos'),[
    'success'=>'js:function(html){
      $("#ajax-exemplos").html(html);
      MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("ajax-exemplos")]);
      $("#btn-ex").slideUp().remove();
    }',
  ],[
    'id'=>'btn-ex',
  ]);?>
  <div id='ajax-exemplos'></div>
</div>


<div id="como-utilizar" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="light">Como utilizar</h4>
      <p><?=$comoUsar;?></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect btn-flat">Ok</a>
    </div>
</div>


<script>
$(document).ready(function(){
  $('#search').focus();
});
</script>

<script>
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
