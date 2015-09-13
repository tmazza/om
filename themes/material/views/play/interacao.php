<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
      <div class='camada camada-sage'>
          <div class='row'>
            <div class='col s12 m7'>
                <div class="textRight" style="color: #aaa;">
                    Utilizando linguagem <?= CHtml::link(ucfirst($note->getLanguage()), $this->createUrl('linguagem/'.$note->getLanguage())); ?>. Autor: <?= CHtml::link($note->autor->perfil->nome, $this->createUrl('user/index',array('id'=>$note->user_id))); ?>
                </div>
            </div>
            <div class='col s12 m5 right-align'>
              <?php
              echo CHtml::ajaxLink('Copiar para o meu notebook', $this->createUrl('play/copy', array(
                          'id' => $note->publicId,
                      )), array(
                  'update' => '#feedback-copy',
                  'beforeSend' => 'js: function() { $("#feedback-copy").html("Copiando..."); }',
              ));
              ?>
            </div>
          </div>

          <div class='row'>
            <div class='col s12'>
                <div id="feedback-copy"></div>
            </div>
          </div>
          <div class='sage-hide-code'>
              <div class='fake-link-content'>
                  <div class='sage-auto'>
                      <script type='text/x-sage'><?php echo CHtml::decode(stripslashes($note->codigo)); ?></script>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
