<script>
    sagecell.makeSagecell({
        inputLocation: '#note-code-<?= $note->id ?>',
        evalButtonText: 'Atualizar',
        autoeval: false,
        hide: ['permalink'],
        languages: ["<?= $note->getLanguage(); ?>"],
    });
</script>
<div class="card-panel">
    <div class='flow-text'>
      <?php
      $hash = hash('crc32',microtime(true));
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
    </div>
    <br>
    <div class="divider"></div>
    <br>
    <div>
        <?php $this->renderPartial('_saveButton', array('note' => $note)); ?>
    </div>
    <br>
    <br>

    <div class="box-body" id='code-edit-<?= $note->id ?>'>
        <textarea id='note-code-<?= $note->id; ?>'><?php echo CHtml::decode(stripslashes($note->codigo)); ?></textarea>
    </div>
    <br>
    <div class="divider"></div>
    <br>
    <?php
    if($note->sharing) {
      $this->renderPartial('_share',array('note'=>$note));
    } else {
      $this->renderPartial('_shareButton',array('note'=>$note));
    }
    ?>
</div>
