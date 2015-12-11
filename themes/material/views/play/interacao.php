<div class="container" style="margin-top:-49px;">
  <div class="card-panel">
      <div class='camada camada-sage'>
          <div class='row'>
            <div class='col s12 m7'>
                <div class="textRight" style="color: #aaa;">
                  Autor: <b><?=$note->autor->perfil->nome;?></b>
                </div>
            </div>
            <div class='col s12 m5'>
              <div class="right">
              &nbsp;&nbsp;
              &nbsp;&nbsp;
                <?php
                $url =  urlencode('http://' . $_SERVER['HTTP_HOST'].Yii::app()->request->url);
                ShView::shareLinks($url);
                ?>
              </div>
              <?php
              echo CHtml::ajaxLink('<i class="tiny material-icons left">content_copy</i>Copiar código', $this->createUrl('play/copy', array(
                          'id' => $note->publicId,
                      )), array(
                  'update' => '#feedback-copy',
                  'beforeSend' => 'js: function() { $("#feedback-copy").html("Copiando..."); }',
              ),array('class'=>'right'));
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

          <div class="row">
            <div class='col s6'>
              &nbsp;
            </div>
            <div class='col s6 right-align grey-text'>
              Utilizando linguagem <?= CHtml::link(ucfirst($note->getLanguage()), $this->createUrl('linguagem/'.$note->getLanguage())); ?>.
            </div>
          </div>

      </div>
  </div>
</div>
