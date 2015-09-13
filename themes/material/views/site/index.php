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
      <a onclick="$('#search-form').submit();" class="right btn-floating btn-large waves-effect waves-light grey darken-3 ">=</a>
    </div>
  </div>
  <div class='row'>
    <div class='col s12'>
      <a href='<?=$this->createUrl('site/aleatorio')?>' class="btn-flat grey lighten-3 right waves-effect waves-light hoverable tooltipped" data-position='left' data-tooltip="Exemplo aleatório">
        <?=CHtml::image(Yii::app()->baseUrl.'/themes/material/assets/img/media-shuffle.png','',array('style'=>'width:24px;padding-top:7px;'));?>
      </a>
      <a onclick='$(this).next().slideToggle();' href='#!' class="btn-flat grey lighten-3 waves-effect waves-light hoverable tooltipped" data-position='right' data-tooltip="Teclado">
        <i class="material-icons black-text">keyboard</i>
      </a>
      <?php
      $this->widget('shared.widgets.Teclado.ViewTeclado', array(
          'inputID' => 'search',
          'tecladoID' => Teclado::Arquimedes,
          'template' => 'template5',
      ));
      ?>

    </div>
  </div>

  <div class='card-panel'>

    <!--TESTE share-->
    <?php
    $this->widget('shared.widgets.Arquimedes.Arquimedes', array(
        'tecladoTemplate' => 'template3',
        'showSearchInput' => false,
        'shareLinks' => $query,
    ));

    ?>

    <?php if (!$query): ?>
      <p class='flow-text center-align grey-text text-darken-3'>
        Use números, funções f(x),  f(x,y) ou os exemplos de instruções abaixo
        <br>
        <br>
      </p>
    <?php endif; ?>

    <div class='divider'></div>
    <br>
    <div class="row">
      <div class="col m6 s12 flow-text">
        Exemplos
      </div>
      <div class="col m6 s12">
        <input type='search' id='se' placeholder="Buscar exemplo..." />
      </div>
    </div>
    <div id='sr'></div>
    <?php $this->renderPartial('exemplos',array('exemplos'=>$exemplos)); ?>
  </div>
</div>
<script>
$('#se').keyup(function(){
  $('#sr').html('<div class="progress"><div class="indeterminate"></div></div>');

  var s = $(this).val();
  nodes = []
  if(s.length > 0){
    $('.s').each(function(){
      if($(this).text().toLowerCase().indexOf(s.toLowerCase()) !== -1){
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

</script>
