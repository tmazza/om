<?php
$query = !isset($_GET['q']) || (isset($_GET['q']) && strlen($_GET['q']) == 0) ? false : $_GET['q'];
$textoComoUsar = 'Como usar?';
?>
<div class="container" style="margin-top:-49px;">
  <div class='row'>
    <div class='col m10 s9'>
      <nav class='white'>
        <div class="nav-wrapper">
          <form method="get" id='search-form' action="<?php echo $this->createUrl('site/index'); ?>">
            <div class="input-field" style="color:#000;">
              <?php
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                  'name' => 'q',
                  'value' => $query,
                  'source' => Yii::app()->controller->createUrl('search/AutocompleteInstrucao'),
                  'options' => array(
                      'minLength' => '1',
                      'select'=>'js: function(event,ui){
                        window.location.assign("/app/?q="+encodeURI(ui.item.value)+"#OM")
                      }',
                      'response'=>'js:function(event,ui){
                        MathJax.Hub.Queue(["Typeset",MathJax.Hub,document.getElementById("ui-id-1")])
                      }',
                  ),
                  'htmlOptions' => array(
                      'id' => 'search',
                      'autocomplete' => 'off',
                      'required' => true,
                      // 'placeholder' => '',
                      'style' => 'padding-left:1rem;border:none!important;box-shadow:none!important;',
                      // 'type' => 'search',
                  ),
              ));
              ?>
            </div>
          </form>
        </div>
      </nav>
    </div>
    <div class='col m1 hide-on-small-only'>&nbsp;</div>
  <div class='col s3 m1' style="padding-top:2px;"  id='OM'>
      <a onclick="$('#search-form').submit();" class="right btn-floating btn-large waves-effect waves-light blue-grey lighten-1 ">=</a>
    </div>
  </div>
  <div class='row' style="margin-bottom: 0px;">
    <div class='col s12'>
      <?php if(!$query): ?>
        <div class='row hide-on-large-only '  style="margin-bottom: 0px;">
          <div class='col s12 center-align'>
            <a class="waves-effect waves-light btn-flat modal-trigger" href="#como-utilizar"><?=$textoComoUsar;?></a>
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
          <a class="waves-effect waves-light btn-flat modal-trigger" href="#como-utilizar"><?=$textoComoUsar;?></a>
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
<!-- <div class="container">
  <div class="card-panel">
      Exemplos:
      <input type='search' id='se' placeholder="Buscar..." />
    <div id='sr'></div>
    <?php //$this->renderPartial('exemplos',array('exemplos'=>$exemplos)); ?>
  </div>
</div> -->


<div id="como-utilizar" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="light"><?=$textoComoUsar;?></h4>
      <p><?=$comoUsar;?></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect btn-flat">Ok</a>
    </div>
</div>


<script>
$('#se').keyup(function(){
  $('#sr').html('<div class="progress"><div class="indeterminate"></div></div>');

  var s = $(this).val().trim();
  nodes = []
  if(s.length > 0){
    $('.s').each(function(){
      var txt = $(this).text().toLowerCase() + '-' +  $(this).next().text().toLowerCase();
      if(txt.indexOf(s.toLowerCase()) !== -1){
        nodes.push($(this).parent().parent().clone());
      }
    });
  }
  $('#sr').text('');
  for(i=0;i<nodes.length;i++){
    $('#sr').append(nodes[i]);
    $('#sr').append('<div class="divider"></div>');
  }
});


$(document).ready(function(){
  $('#search').focus();
});
</script>