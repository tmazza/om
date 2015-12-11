<div class='flow-text'>
  <?php
  echo CHtml::ajaxLink('  <i class="material-icons red-text text-lighten-2 right">clear</i>',$this->createUrl('/home/interacao/delete',array(
    'id'=>$note->id,
  )),array(
      'success' => 'js: function(){ $("#note-' . $note->id . '").slideUp(); }',
  ),array(
    'confirm' => 'Confirma exclusão de interação?',
    'title' => 'Excluir',
    'id' => $hash . 'delete-note-'.$note->id,
  ));
  ?>

  <a href='#!' onclick="hideInteracao(<?=$note->id?>)" title='Minimizar'>
      <i class="material-icons black-text right">remove</i>
  </a>

  <?= ucfirst($note->getLanguage()); ?>
  <?php
  echo CHtml::ajaxLink('<i class="tiny material-icons">edit</i>',$this->createUrl('#'),array(
    ''
  ),array(
      'class' => 'grey-text',
      'title' => 'Alterar nome',
  ));
  ?>
</div>
