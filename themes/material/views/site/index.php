<?php
$query = !isset($_GET['q']) || (isset($_GET['q']) && strlen($_GET['q']) == 0) ? false : $_GET['q'];
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
                  ),
                  'htmlOptions' => array(
                      'id' => 'search',
                      'autocomplete' => 'off',
                      'required' => true,
                      // 'placeholder' => 'Use números, funções f(x), f(x,y) ou os exemplos de instruções abaixo',
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
  <div class='row'>
    <div class='col s12'>
      <?php if(!$query): ?>
        <div class='row hide-on-large-only '>
          <div class='col s12 center-align'>
            Use números, f(x) ou f(x,y) com o auxílio da Calculadora ou use instruções como nos Exemplos
          </div>
        </div>
      <?php endif; ?>
      <div class='row'>
        <div class='col s6 l2'>
          <a onclick='$("#tec-btn-box-search").slideToggle();' href='#!' class="btn-flat grey lighten-3 waves-effect waves-light hoverable tooltipped" data-position='right' data-tooltip="Teclado">
            <i style='font-size:1.7em' class="material-icons black-text">keyboard</i>
          </a>
        </div>
        <div class='col s12 l8 hide-on-med-and-down center-align'>
          Use números, f(x) ou f(x,y) com o auxílio da Calculadora ou use instruções como nos Exemplos
        </div>
        <div class='col s6 l2'>
          <a href='<?=$this->createUrl('site/aleatorio')?>' class="btn-flat grey lighten-3 right waves-effect waves-light hoverable tooltipped" data-position='left' data-tooltip="Exemplo aleatório">
            <?=CHtml::image(Yii::app()->baseUrl.'/themes/material/assets/img/media-shuffle.png','',array('style'=>'width:24px;padding-top:7px;'));?>
          </a>
        </div>
      </div>

      <?php
      $this->widget('shared.widgets.Teclado.ViewTeclado', array(
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
      $this->widget('shared.widgets.Arquimedes.Arquimedes', array(
          'tecladoTemplate' => 'template3',
          'showSearchInput' => false,
          'shareLinks' => $query,
      ));
      ?>
    </div>
  <?php endif; ?>
</div>
<?php
echo '<div class="container hide-on-med-and-up" >';
$url =  urlencode('http://' . $_SERVER['HTTP_HOST'].Yii::app()->request->url);
ShView::shareLinks($url);
echo '</div><br>';
?>
<div class="container">
  <div class="card-panel">
      Exemplos:
      <input type='search' id='se' placeholder="Buscar..." />
    <div id='sr'></div>
    <?php $this->renderPartial('exemplos',array('exemplos'=>$exemplos)); ?>
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
