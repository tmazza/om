<br>
<div class="">
    <?php
    $ajaxBehaviour = array(
        'beforeSend' => 'js: function(){  '
        . '$("<div id=\'loading-note\'><div class=\'progress\'><div class=\'indeterminate\'></div></div></div>").prependTo("#notes-list"); '
        . '}',
        'success' => 'js: function(html){  '
        . '$("" + html + "").prependTo("#notes-list"); '
        . '$("#loading-note").remove();'
        . '}',
    );
    echo CHtml::ajaxLink('Sage', $this->createUrl('/home/interacao/novaInteracao', array('tipo' => Notebook::Sage)), $ajaxBehaviour, array('class' => 'btn blue-grey darken-1'));
    // echo ' ' . CHtml::ajaxLink('Singular', $this->createUrl('/home/interacao/novaInteracao', array('tipo' => Notebook::Singular)), $ajaxBehaviour, array('class' => 'btn blue-grey darken-1'));
    // echo ' ' .CHtml::ajaxLink('R', $this->createUrl('/home/interacao/novaInteracao', array('tipo' => Notebook::R)), $ajaxBehaviour, array('class' => 'btn blue-grey darken-1'));
    echo ' ' .CHtml::ajaxLink('Python', $this->createUrl('/home/interacao/novaInteracao', array('tipo' => Notebook::Python)), $ajaxBehaviour, array('class' => 'btn blue-grey darken-1'));
    ?>
</div>
<br>
<div id="notes-list">
    <?php if (count($notes) > 0): ?>
        <?php foreach ($notes as $n): ?>
          <div id='note-<?=$n->id?>'>
          <?php
          $this->renderPartial('_hideInt',array('n'=>$n));
          ?>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
      <h3 class="grey-text center-align flow-text">
        Nenhuma interação criada.
        <br>Clique na linguagem que deseja, acima, para começar.
      </h3>
    <?php endif; ?>
</div>
<div id="mshare" class="modal">
  <div class="modal-content">
    <h4>Share</h4>
    <p id='content'>
      adadad
    </p>
  </div>
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
  </div>
</div>

<script>
function loadInteracao(id){
  $.ajax({
    type: "GET",
    url: '<?=$this->createUrl('/home/interacao/load')?>',
    data: {id:id},
    beforeSend: function(){
      $('#note-'+id).html("<p class=''><div class='progress'><div class='indeterminate'></div></div></p>");
    },
    success: function(html){
      $('#note-'+id).html(html);
    },
  });
}
function hideInteracao(id){
  $.ajax({
    type: "GET",
    url: '<?=$this->createUrl('/home/interacao/hide')?>',
    data: {id:id},
    beforeSend: function(){
      $('#note-'+id).html("<p class=''><div class='progress'><div class='indeterminate'></div></div></p>");
    },
    success: function(html){
      $('#note-'+id).html(html);
    },
  });
}
</script>
