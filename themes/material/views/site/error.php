<div class="container" style="margin-top:-49px;">
  <div class='card-panel'>
        <h5 class="center-align">Erro <?php echo $code; ?></h5>
        <p class="center-align">
          <br>
          <i class='material-icons medium red-text'>mood_bad</i>
          <br>
          <br>
          <?php echo CHtml::encode($message); ?>
          <br>
          <br>
          <div class='divider'></div>
          <br>
          <br>
          <div class="center-align">
          <a href='<?=$this->createUrl('site/aleatorio')?>' class="btn-flat waves-effect">
            Mostre-me algo interssante!
            <?=CHtml::image(Yii::app()->baseUrl.'/themes/material/assets/img/media-shuffle.png','',array('style'=>'float:right; width:40px;padding-left:12px;padding-top:4px;'));?>
          </a>
          </div>
        </p>
  </div>
</div>
