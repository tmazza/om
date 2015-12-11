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
    <div id='title'>
      <?php
      $hash = hash('crc32',microtime(true));
      $this->renderPartial('titulo',array(
        'note' => $note,
        'hash' => $hash,
      ));
      ?>
    </div>
    <br>
    <div class="divider"></div>
    <br>
    <div>
        <?php $this->renderPartial('_saveButton', array('note' => $note)); ?>
    </div>
    <br>
    <br>

    <div class="sage-int" id='code-edit-<?= $note->id ?>'>
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
